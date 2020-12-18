git add -A
git commit -m "$*" -s
./build.sh
git add -A
git commit -m "Built static site" -s
git push