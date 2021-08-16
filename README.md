# Google Grass Maker | 谷歌生草机
须弥空荡荡，草神在人间。  
让一段文字变得生草，且不完全改变其原本的意思。
## 接口
https://api.raygroup.com.cn/googleGrassMaker
## 方法
GET / POST  
## 参数
1、（必选）lang：原文采用语言的国际化缩写，不需要加地区名，例如：zh（中文）。  
2、（必选）force：生草力度，为阿拉伯数字，最小为 1，建议最大不超过 10，例如：6。  
3、（必选）text：要进行生草的原文，中文建议先进行 URI 编码。  
## 返回
格式为 JSON  
1、isOk：是否正常生草，如正常为 ok，否则为 err。  
2、lang：文本采用语言的国际化缩写。  
3、text：经过生草后的文字，非英语文字（国际化缩写：en）可能会被 Unicode 编码。  
## 示例
请求：https://api.raygroup.com.cn/googleGrassMaker?lang=zh&force=6&text=%E6%9C%89%E4%B8%80%E4%B8%AA%E4%BA%BA%E5%89%8D%E6%9D%A5%E4%B9%B0%E7%93%9C  
返回：{"isOk":"ok","lang":"zh","text":"\u6709\u4eba\u6765\u4e70\u74dc"}（在实际使用中，text值可能会和这个示例不一样）
## 原理
使用谷歌翻译成某个小语种，然后再翻译回原来的语言。
## 源码
GitHub 仓库地址：https://github.com/Ray917/google-grass-maker  
Gitee 仓库地址：https://gitee.com/Ray917/google-grass-maker
## Copyright
2021 RayGroup. All Rights Reserved.
## Thanks
Google Translate.
