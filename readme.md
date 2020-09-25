# LineBot

# 遇到的ERROR處理辦法及重要筆記

## Log could not be opened: failed to open stream: Permission denied 解決方法
*  chown laradock:laradock ./storage -R

## Request Message array 格式

## LINE Message 格式
```
 array (
  'events' =>
  array (
    0 =>
    array (
      'type' => 'message',
      'replyToken' => 'd439xxxxxxx1fc48',
      'source' =>
      array (
        'userId' => 'xxxx',
        'type' => 'user',
      ),
      'timestamp' => 1565081621327,
      'message' =>
      array (
        'type' => 'text',
        'id' => '10343775297084',
        'text' => 'hi kejyun line bot',
      ),
    ),
  ),
  'destination' => 'Ued2b13xxxxxx804b',
)
```

