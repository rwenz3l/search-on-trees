for diskpath in /mnt/*; do
  drive=$(basename ${diskpath})
  echo "--> PATH: ${diskpath}"
  if $(mountpoint -q ${diskpath}); then
    echo "----> CREATE LOG: ${drive}"
    if [[ "${drive}" == "safe"* ]]; then
      echo ">> Archive"
      mkdir -p index/archive
      out="archive/${drive}"
    else
      echo ">> XServe"
      mkdir -p index/xserve
      out="xserve/${drive}"
    fi
    tree -fFhins --du ${diskpath} -o index/${out}.log
  fi
done