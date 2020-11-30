git add -A
git commit -m "$*"
./build.sh
git add -A
git commit -m "Built static site"
git push