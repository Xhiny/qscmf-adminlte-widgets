# qscmf-adminlte-widgets
adminlte 组件

## 安装

```php
composer require quansitech/qscmf-adminlte-widgets
```

## 控件列表
+ [Content](https://github.com/quansitech/qscmf-adminlte-widgets#Content)
+ [Row](https://github.com/quansitech/qscmf-adminlte-widgets#Row)
+ [Column](https://github.com/quansitech/qscmf-adminlte-widgets#Column)
+ [Card](https://github.com/quansitech/qscmf-adminlte-widgets#Card)
+ [InfoBox](https://github.com/quansitech/qscmf-adminlte-widgets#InfoBox)

### Content
面板组件，所有的子组件都必须添加到Content组件

面板是表格结构，所有的组件都将基于行列结构嵌入

用法:
```php
//$view 是 Think\View 对象
$content = new Content($view);
//设置面板标题
$content->title('网站概况');
//设置高亮的节点
$content->setNIDByNode('admin','dashboard', 'index');

//设置行组件
$row = new \AdminLTE\Row(new InfoBox('日活', 100, 'info', ['icon' => 'users']));
//\AdminLTE\Row 作为参数
$content->addRow($row);
//HTML字符串作为参数
$box = <<<html
<div style="width:100%;height:100px;background-color: red;"></div>
html;
//当非Row组件作为参数时，可设置第二个参数来设定行所占宽度（总共12）
$content->addRow($box, 6);

//渲染html页面
$content->display();
```

### Row
行组件，行是面板表格的基础结构

用法：
```php
//实例化row
$row = new Row();
//也可以传入Column类型对象
$row = new Row(new Column(new InfoBox('日活', 100, 'info', ['icon' => 'users'])));
//或者是html字符串, 此时可传入第二个参数来设定所占宽度(总共12)
$box = <<<html
<div style="width:100%;height:100px;background-color: red;"></div>
html;
$row = new Row($box, 6);

//实例化后，给已有row添加列内容
//例子中的column可以是Html字符串，或者Column对象
//Column对象无须传递第二个参数，传了也无效
$row->addColumn($column, 4);
```

### Column
列组件，列是面板表格的基础结构，一般都会嵌入行组件中使用

用法：
```php
$box = <<<html
<div style="width:100%;height:100px;background-color: red;"></div>
html;
//实例化column组件
//第一个参数为html字符串，或者是实现了__toString魔术函数的对象
//第二个参数为宽度，默认是12
$column = new Column($box, 12);
$box2 = <<<html
<div style="width:100%;height:100px;background-color: yellow;"></div>
html;
//向Column追加内容
//接受html字符串，或者实现了__toString魔术函数的对象
$column->append($box2);
```

### Card
可折叠关闭的容器组件

用法:
```php
//第一个参数，设定card body部分的html内容，或者是实现了__toString魔术函数的对象
//第二个参数，card的标题
//第三个参数，card header的背景色，见主题颜色说明
//第四个参数，是否启动折叠功能
//第五个参数，是否启动关闭功能
$card new Card($card_row, '统计', 'danger', true, true);

//设置body内容
//参数类型，html字符串或者实现了__toString魔术函数的对象
$card->setBody($body);

//是否开启折叠功能
$card->setCollapse(true);

//是否开启关闭功能
$card->setRemove(true);

//设置标题
$card->setTitle('趋势图');

//设置header背景颜色
//参数是主题颜色，见主题颜色说明
$card->setBg($bg);
```


### InfoBox
可设置图标，说明文字，数字，提示的数据展示组件

用法：
```php
//实例化
//第一个参数，数据描述
//第二个参数，数据
//第三个参数，背景主题色，见主题颜色说明
//第四个参数，icon
$box = new InfoBox('参与人', 200, 'info', 'users');

//设置说明提示
$box->setTips('报名人数');

//设置icon
$box->setIcon('users');

//设置背景主题色
$box->setBg('info');
```

## 背景主题色
<font color=#17a2b8>info</font>



