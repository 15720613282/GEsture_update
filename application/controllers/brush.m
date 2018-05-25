function [r,p,newy]=brush(readfilename,username)
%set(0,'diaryFile',outfilename);
%diary
filename=strcat('/home/yening/cyw/web/File/',username);
filename=strcat(filename,'/');
mx=csvread(fullfile(filename,'/write1.csv'));
my=csvread(fullfile(filename,'/write2.csv'));
fpath=strcat('/home/yening/cyw/web/uploads/',username);
   [ddata,genes] = xlsread(fullfile(fpath,readfilename));
%  ex=importdata(fullfile('/Users/carrie/Documents/MATLAB/GestureSearch_V0.8/data',readfilename));
%  ddata=ex.data;
%  genes=ex.textdata;
 emptySpots = strcmp('EMPTY',genes);
ddata(emptySpots,:) = [];
genes(emptySpots) = [];

%  nanIndices = any(isnan(ddata),2);
%       ddata(nanIndices,:) = [];
%       genes(nanIndices) = [];
mask = genevarfilter(ddata);
ddata = ddata(mask,:);
genes = genes(mask);

%  [mask, ddata, genes] = genelowvalfilter(ddata,genes,...
%                                                          'absval',log2(3));
% 
 [mask, ddata, genes] = geneentropyfilter(ddata,genes,...
                                                            'prctile',10);

      recordNum=length(ddata(:,1));
      samples=length(ddata(1,:));
%       m=max(max(ddata));
%       n=min(min(ddata));
      
%       if (m-n)>10000
%           for i=1:recordNum
%               for j=1:samples
%                   if ddata(i,j)~=0
%                    ddata(i,j)=log2(ddata(i,j));   
%                   end
%               end
%           end   
%           ddata=log2(ddata);
%       end 
      
%       [r,c]=find(ddata==-Inf);
%        ddata(r,c)=0;
   
    a=spline(mx,my);
    newy=ppval(a,[1:samples]');
    newy=newy';
   csvwrite(strcat(filename,'newy.csv'),newy);
 
   for i=1:recordNum
   [r,p]=corrcoef(newy,ddata(i,:));
    rVal(i)=r(1,2);
    pVal(i)=p(1,2);
   end
  
 [R,IXR]=sort(rVal','descend');
IX1=R>0.67;

sortData=ddata(IXR,:);
sortGenes=genes(IXR,:);
sortPval=pVal(IXR);
sortRval=rVal(IXR);
newData=sortData(IX1,:);
 
 
newGenes=sortGenes(IX1,:);
%disp(newGenes)


newPval=sortPval(IX1);
newPval=newPval';
newRval=sortRval(IX1);
newRval=newRval';
  
  selectData=table(newGenes,newPval,newRval,newData);
 writetable(selectData,strcat(filename,'all_newdata.csv'));
  
%diary
end

