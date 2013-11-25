#/bin/bash

# Fix me: This is too dirty. 

set d = pwd

cd "$(cd -- "$(dirname -- "${BASH_SOURCE:-$0}")"; pwd)"
cd ../public


ln -s ../vendor/angular/app angular

cd $d

exit 0
