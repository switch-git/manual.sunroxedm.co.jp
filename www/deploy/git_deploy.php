<?php
exec('/usr/bin/git --git-dir=/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/manual.sunroxedm.co.jp.git fetch', $output, $return_var);
exec('/usr/bin/git --git-dir=/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/manual.sunroxedm.co.jp.git reset --hard origin/main ', $output, $return_var);
exec('/usr/bin/git --git-dir=/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/manual.sunroxedm.co.jp.git --work-tree=/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/src checkout -f', $output, $return_var);
$commit_hash = shell_exec('/usr/bin/git --git-dir=/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/manual.sunroxedm.co.jp.git rev-parse --verify HEAD');
file_put_contents('/home/hada821/webservice-dev.com/git/manual.sunroxedm.co.jp.webservice-dev.com/log/deploy.log', date('r') . " Ref: " .  "" . " Commit: " . $commit_hash . "\n", FILE_APPEND);
