function  flag=Normalize_file(username,readfilename)
filename=strcat('/home/yening/cyw/web/File/',username);
filename=strcat(filename,'/');
fpath=strcat('/home/yening/cyw/web/uploads/',username);
fpathfile1=strcat(fpath,'/');
fpathfile=strcat(fpathfile1,readfilename);
 ex=importdata(fullfile(fpath,readfilename));
  ddata=ex.data;
  genes=ex.textdata;
  ddata2=zscore(ddata);
 
 normalize_Data=table(genes,ddata2);
 writetable(normalize_Data,fpathfile,'WriteVariableNames',false);
 flag=1;
end
