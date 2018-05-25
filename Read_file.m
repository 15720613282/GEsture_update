function [m,n,recordNum,samples]=Read_file(username,readfilename)
filename=strcat('/home/yening/cyw/web/File/',username);
filename=strcat(filename,'/');
fpath=strcat('/home/yening/cyw/web/uploads/',username);
   %[ddata,genes] = xlsread(fullfile(fpath,readfilename));
 ex=importdata(fullfile(fpath,readfilename));
  ddata=ex.data;
m=max(max(ddata));
n=min(min(ddata));
      recordNum=length(ddata(:,1));
      samples=length(ddata(1,:));
Data=table(m,n,recordNum,samples);
 writetable(Data,strcat(filename,'filesize.csv'));
end
