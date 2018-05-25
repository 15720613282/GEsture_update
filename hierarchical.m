%load yeastdata.mat
 [yeastvalues,genes] = xlsread(fullfile('/Users/carrie/Documents/MATLAB/GestureSearch_V0.8/data','yeastExpression.xls'));
 times=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18];
 filename='/Applications/XAMPP/xamppfiles/htdocs/GeneNetwork/File/';
 
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

clusters = cluster(clusterTree, 'maxclust', 10);

% figure
% for c = 1:16
%     subplot(4,4,c);
%     plot(times,yeastvalues((clusters == c),:)');
%     axis tight
% end
% suptitle('Hierarchical Clustering of Profiles');
% rng('default');
 
 [cidx, ctrs] = kmeans(yeastvalues, 10, 'dist','corr', 'rep',5,...
                                                         'disp','final');
  csvwrite(strcat(filename,'gdata.csv'),ctrs);
                                                   
figure
for c = 1:10
    subplot(2,5,c);
    plot(times,yeastvalues((cidx == c),:)');
    axis tight
end
suptitle('K-Means Clustering of Profiles');
genedata=table(genes,cidx,yeastvalues);
writetable(genedata,strcat(filename,'Kcluster.csv'));

figure
for c = 1:10
    subplot(2,5,c);
    plot(times,ctrs(c,:)');
    axis tight
    axis off    % turn off the axis
end
suptitle('K-Means Clustering of Profiles');