#/bin/bash

# Fix me: This is too dirty. 

set d = pwd

cd "$(cd -- "$(dirname -- "${BASH_SOURCE:-$0}")"; pwd)"
cd ..


ln -s vendor/angular/app public_html

cd $d

exit 0
