function [r,p,newy]=shift(a_value,readfilename,username,L,R)
%set(0,'diaryFile',outfilename);
%diary
filename=strcat('/home/yening/cyw/web/File/',username);
filename=strcat(filename,'/');
mx=csvread(fullfile(filename,'/write1.csv'));
my=csvread(fullfile(filename,'/write2.csv'));
co=importdata(fullfile(filename,'/all_newdata.csv'));
co_genes=co.textdata;
co_genes=co_genes(:,1);
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
  %                                                       'absval',1);
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
      
      
      
      
   % a=spline(mx,my);
    b=spline(mx((R+1):end), my(1:end-R));
    c=spline(mx(1:end-abs(L)), my(abs(L)+1:end));
   % newy=ppval(a,[1:samples]');
    %snewy_a=ppval(a,[1:samples]');
    snewy_b=ppval(b,[1:samples]');
    snewy_c=ppval(c,[1:samples]');
    %newy=newy';
   % snewy_a=snewy_a';
    snewy_b=snewy_b';
    snewy_c=snewy_c';
   %csvwrite('/Applications/XAMPP/xamppfiles/htdocs/GeneNetwork/File/c_newy.csv',newy);
   for i=1:recordNum 
  % [ra,pa]=corrcoef(snewy_a,ddata(i,:));
   [rb,pb]=corrcoef(snewy_b,ddata(i,:));
   [rc,pc]=corrcoef(snewy_c,ddata(i,:));
   % rVal_a(i)=ra(1,2);
   % pVal_a(i)=pa(1,2);
    rVal_b(i)=rb(1,2);
    pVal_b(i)=pb(1,2);
    rVal_c(i)=rc(1,2);
    pVal_c(i)=pc(1,2);
   end
  
% [R_a,IXR_a]=sort(rVal_a','descend');
%IX1_a=R_a>a_value;

[R_b,IXR_b]=sort(rVal_b','descend');
IX1_b=R_b>a_value;

[R_c,IXR_c]=sort(rVal_c','descend');
IX1_c=R_c>a_value;
a_value=0.68;
while(sum(IX1_b(:)==1)>1000||sum(IX1_c(:)==1)>1000)
      if a_value>0.9
          break;
      end
     IX1_b=R_b>a_value;
     IX1_c=R_c>a_value;
     a_value=a_value+0.01;
   
end
%sortData_a=ddata(IXR_a,:);
%sortGenes_a=genes(IXR_a,:);
%sortPval_a=pVal_a(IXR_a);
%newDataa=sortData_a(IX1_a,:);
%sortRval_a=rVal_a(IXR_a);

sortData_b=ddata(IXR_b,:);
sortGenes_b=genes(IXR_b,:);
sortPval_b=pVal_b(IXR_b);
newDatab=sortData_b(IX1_b,:);
sortRval_b=rVal_b(IXR_b);

sortData_c=ddata(IXR_c,:);
sortGenes_c=genes(IXR_c,:);
sortPval_c=pVal_c(IXR_c);
newDatac=sortData_c(IX1_c,:);
sortRval_c=rVal_c(IXR_c);


%newGenesa=sortGenes_a(IX1_a,:); 
newGenesb=sortGenes_b(IX1_b,:);
newGenesc=sortGenes_c(IX1_c,:);
%disp(newGenesb)
%csvwrite(strcat(filename,'newGenes_b.csv'),newGenesb);
%csvwrite(strcat(filename,'newGenes_c.csv'),newGenesc);
%newPval_a=sortPval_a(IX1_a); 
newPval_b=sortPval_b(IX1_b); 
newPval_c=sortPval_c(IX1_c);
%newPval_a=newPval_a';
newPval_b=newPval_b';
newPval_c=newPval_c';

%newRval_a=sortRval_a(IX1_a); 
newRval_b=sortRval_b(IX1_b); 
newRval_c=sortRval_c(IX1_c);
%newRval_a=newRval_a';
newRval_b=newRval_b';
newRval_c=newRval_c';

%csvwrite(strcat(filename,'pval_b.csv'),newPval_b);
%csvwrite(strcat(filename,'pval_c.csv'),newPval_c);


  %M=csvread(strcat(filename,'all_newdata.csv'),2,1);
  %M=csvread(strcat(filename,'all_newdata.csv'),2,3);
   %newGenes=M(:,1)
   %newPval=M(:,2)
%   newRval=M(:,3)
%   newData1=M(:,4:end);
[rnewData,rnewGenes,rnewPval,rnewRval,lnewData,lnewGenes,lnewPval,lnewRval]=deRepeat(...
      co_genes,newDatab,newGenesb,newPval_b,newRval_b,newDatac,newGenesc,newPval_c,newRval_c);

% newGenes=[newGenesa;rnewGenes;lnewGenes];
% newPval=[newPval_a;rnewPval;lnewPval];
% newData=[newDataa;rnewData;lnewData];
% newRval=[newRval_a;rnewRval;lnewRval];
 newGenes=[rnewGenes;lnewGenes];
 newPval=[rnewPval;lnewPval];
 newData=[rnewData;lnewData];
 newRval=[rnewRval;lnewRval];
 r=ones(size(rnewGenes,1),1);
l=ones(size(lnewGenes,1),1)*-1;
newclass=[r;l];

ldata=table(lnewData);
writetable(ldata,strcat(filename,'outData_l.csv'));
rdata=table(rnewData);
writetable(rdata,strcat(filename,'outData_r.csv'));

 selectData=table(newGenes,newPval,newRval,newclass,newData);
 writetable(selectData,strcat(filename,'s_all_newdata.csv'));
 
end

