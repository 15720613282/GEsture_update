function [rnewData,rnewGenes,rnewPval,rnewRval,lnewData,lnewGenes,lnewPval,lnewRval]=deRepeat(newGenes,rnewData,rnewGenes,rnewPval,rnewRval,lnewData,lnewGenes,lnewPval,lnewRval)
    len1=length(newGenes);
    len2=length(rnewPval);
    len3=length(lnewPval);
    Mask2=ones(len2,1);
    Mask3=ones(len3,1);
    for i=2:len1
        for j=1:len2
            if strcmp(newGenes(i),rnewGenes(j))==1
                Mask2(j)=0;
            end
        end
        for k=1:len3
            if strcmp(newGenes(i),lnewGenes(k))==1
                Mask3(k)=0;
            end
        end
    end
for j=1:len2
           for k=1:len3
            if strcmp(rnewGenes(j),lnewGenes(k))==1
                Mask3(k)=0;
            end
           end
end
rnewData=rnewData(logical(Mask2),:);
rnewGenes=rnewGenes(logical(Mask2),:);
rnewPval=rnewPval(logical(Mask2));
rnewRval=rnewRval(logical(Mask2));

lnewData=lnewData(logical(Mask3),:);
lnewGenes=lnewGenes(logical(Mask3),:);
lnewPval=lnewPval(logical(Mask3));
lnewRval=lnewRval(logical(Mask3));
