function contrast(a_value,readfilename,username)
%set(0,'diaryFile',outfilename);
%diary
filename=strcat('/home/yening/cyw/web/File/',username);
filename=strcat(filename,'/');
%mx_p=csvread(fullfile(filename,'/write1.csv'));
%my_p=csvread(fullfile(filename,'/write2.csv'));
mx=csvread(fullfile(filename,'/write3.csv'));
my=csvread(fullfile(filename,'/write4.csv'));

 bname=username(1:3);
if bname=='WCY'
  fpath='/home/yening/cyw/web/uploads/WCY';
else
  fpath=strcat('/home/yening/cyw/web/uploads/',username);
end
 ex=importdata(fullfile(fpath,readfilename));
 ddata=ex.data;
  genes=ex.textdata;
 emptySpots = strcmp('EMPTY',genes);
ddata(emptySpots,:) = [];
genes(emptySpots) = [];

   nanIndices = any(isnan(ddata),2);
       ddata(nanIndices,:) = [];
       genes(nanIndices) = [];
      
%mask = genevarfilter(ddata);
%ddata = ddata(mask,:);
%genes = genes(mask);
 % [mask, ddata, genes] = genelowvalfilter(ddata,genes,...
  %                                                        'absval',log2(3));
% 
[mask, ddata, genes] = geneentropyfilter(ddata,genes,...
                                                           'prctile',10);

      recordNum=length(ddata(:,1));
      samples=length(ddata(1,:));
      
%       m=max(max(ddata));
%       n=min(min(ddata));
%       if (m-n)>10000
%           ddata=log2(ddata);
%       end 
%       [r,c]=find(ddata==-Inf);
%        ddata(r,c)=0;
%    
    a=spline(mx,my);
    newy=ppval(a,[1:samples]');
    newy=newy';
 %  b=spline(mx_p,my_p);
 % newy_p=ppval(b,[1:samples]');
 %newy_p=newy_p';
   csvwrite(strcat(filename,'c_newy.csv'),newy);
 %  csvwrite(strcat(filename,'newy.csv'),newy_p);
   for i=1:recordNum
   [r,p]=corrcoef(newy,ddata(i,:));
    rVal(i)=r(1,2);
    pVal(i)=p(1,2);
   end
  
 [R,IXR]=sort(rVal','descend');
IX1=R>a_value;
a_value=0.68;
 while(sum(IX1(:)==1)>1000)
     if a_value>0.9
         break;
     end
     IX1=R>a_value;
     a_value=a_value+0.01;
end
sortData=ddata(IXR,:);
sortGenes=genes(IXR,:);
sortPval=pVal(IXR);
sortRval=rVal(IXR);
newData=sortData(IX1,:);
csvwrite(strcat(filename,'c_newData.csv'),newData);
newGenes=sortGenes(IX1,:);
%disp(newGenes)
%newGenes=str2cell(newGenes);
%csvwrite(strcat(filename,'c_newGenes.csv'),newGenes);
newPval=sortPval(IX1);
newRval=sortRval(IX1);
 %disp(newPval)
newPval=newPval';
newRval=newRval';
  %csvwrite(strcat(filename,'c_pval.csv'),newPval);
  selectData=table(newGenes,newPval,newRval,newData);
  writetable(selectData,strcat(filename,'c_all_newdata.csv'));
  %dlmwrite('/Applications/XAMPP/xamppfiles/htdocs/GeneNetwork/File/all_newdata.csv',newGenes);
   %dlmwrite('/Applications/XAMPP/xamppfiles/htdocs/GeneNetwork/File/all_newdata.csv',all_newdata,'-append');
%diary
end

