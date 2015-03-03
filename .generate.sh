# generate apigen documentation
./vendor/bin/apigen generate --config=.apigen.neon

# send code coverage to scrutinizer
./vendor/bin/ocular code-coverage:upload --format=php-clover coverage.clover


# push apigen docs to github as gh-pages

## set identity
git config --global user.email "travis@travis-ci.org"
git config --global user.name "Travis"

## add branch
git init
git remote add origin https://${GH_TOKEN}@https://github.com/rutube/php-api-client.git > /dev/null
git checkout -B gh-pages

## push generated files
git add .
git commit -m "apigen docs updated"
git push origin gh-pages -fq > /dev/null