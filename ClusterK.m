function varargout=ClusterK(kinds,filelink,readfilename)
bname=filelink(1:3);
if bname=='WCY'
 filepath='/home/yening/cyw/web/uploads/WCY';
else
filepath=strcat('/home/yening/cyw/web/uploads/',filelink);
end

savefpath=strcat('/home/yening/cyw/web/File/',filelink);
savefpath=strcat(savefpath,'/');
ex = importdata(fullfile(filepath,readfilename));
 yeastvalues=ex.data;
  genes=ex.textdata;
 emptySpots = strcmp('',genes);
yeastvalues(emptySpots,:) = [];
genes(emptySpots) = [];
numel(genes)

nanIndices = any(isnan(yeastvalues),2);
yeastvalues(nanIndices,:) = [];
genes(nanIndices) = [];
numel(genes)


mask = genevarfilter(yeastvalues);
% Use the mask as an index into the values to remove the filtered genes. 
yeastvalues = yeastvalues(mask,:);
genes = genes(mask);
numel(genes)

[mask, yeastvalues, genes] = genelowvalfilter(yeastvalues,genes,...
                                                        'absval',log2(3));
numel(genes)

[mask, yeastvalues, genes] = geneentropyfilter(yeastvalues,genes,...
                                                           'prctile',15);
numel(genes)

corrDist = pdist(yeastvalues, 'corr');
clusterTree = linkage(corrDist, 'average');

clusters = cluster(clusterTree, 'maxclust', kinds);

% figure
% for c = 1:16
%     subplot(4,4,c);
%     plot(times,yeastvalues((clusters == c),:)');
%     axis tight
% end
% suptitle('Hierarchical Clustering of Profiles');
% rng('default');
 
 [cidx, ctrs] = kmeans(yeastvalues, kinds, 'dist','corr', 'rep',5,...
                                                         'disp','final');
  dlmwrite(strcat(savefpath,'gdata.csv'),ctrs);
                                                   
% figure
% for c = 1:16
%     subplot(4,4,c);
%     plot(times,yeastvalues((cidx == c),:)');
%     axis tight
% end
% suptitle('K-Means Clustering of Profiles');
genedata=table(genes,cidx,yeastvalues);

writetable(genedata,strcat(savefpath,'Kcluster.csv'));

% figure
% for c = 1:16
%     subplot(4,4,c);
%     plot(times,ctrs(c,:)');
%     axis tight
%     axis off    % turn off the axis
% end
% suptitle('K-Means Clustering of Profiles');
