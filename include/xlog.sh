for diskpath in /mnt/*; do
  drive=$(basename ${diskpath})
  echo "--> PATH: ${diskpath}"
  if $(mountpoint -q ${diskpath}); then
    echo "----> CREATE LOG: ${drive}"
    if [[ $drive == "save?" ]]; then
      echo ">> Archive"
      out="archive/${drive}"
    else
      echo ">> XServe"
      out="xserve/${drive}"
    fi
    tree -fFhins --du ${diskpath} -o index/${out}.log
  fi
done