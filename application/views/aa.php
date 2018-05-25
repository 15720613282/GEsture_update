<?php
$operafile='yeastExpression.xls';
$filelink='WCY';
system("pwd");
system("unset DISPLAY");//删除DISPLAY环境变量
$text="brush(".'\''.$operafile.'\''.','.'\''.$filelink.'\''.")";
 $a=shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");
