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
+ [Tab](https://github.com/quansitech/qscmf-adminlte-widgets#Tab)
+ [ListBox](https://github.com/quansitech/qscmf-adminlte-widgets#ListBox)

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

函数说明
+ addRow

  设置行内容
 
  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | row | \AdminLTE\Row组件或者html字符串 | object I string | 是   |   |
  | width | 行宽度，最大12，row为object时失效 |  string | 否   |   |
  | auth_node | 行权限点，格式为 '模块.控制器.方法名' |  string I array | 否   |   |

  若auth_node存在多个值，支持配置不同逻辑（logic值为and或者or）判断是否显示该按钮，默认为and：
  and：用户拥有全部权限则显示该按钮，格式为：
  ['node' => ['模块.控制器.方法名','模块.控制器.方法名'], 'logic' => 'and']
  or：用户一个权限都没有则隐藏该按钮，格式为：
  ['node' => ['模块.控制器.方法名','模块.控制器.方法名'], 'logic' => 'or']

### Row
行组件，行是面板表格的基础结构

用法：
```php
//实例化row
$row = new Row();
//也可以传入Column类型对象
$row = new Row(new Column(new InfoBox('日活', 100, 'info', 'users')));
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

函数说明
+ addColumn

  设置行内容

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | column | \AdminLTE\Column组件或者html字符串 | object I string | 是   |   |
  | width | 列宽度，最大12，column为object时失效 |  string | 否   |   |
  | auth_node | 行权限点，格式为 '模块.控制器.方法名' |  string I array | 否   |   |

  若auth_node存在多个值，支持配置不同逻辑（logic值为and或者or）判断是否显示该按钮，默认为and：
  and：用户拥有全部权限则显示该按钮，格式为：
  ['node' => ['模块.控制器.方法名','模块.控制器.方法名'], 'logic' => 'and']
  or：用户一个权限都没有则隐藏该按钮，格式为：
  ['node' => ['模块.控制器.方法名','模块.控制器.方法名'], 'logic' => 'or']

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
$card = new Card($card_row, '统计', 'danger', true, true);

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

函数说明
+ addFooterMore

  添加底部跳转链接

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | url | 链接  | string| 是   |   |
  | title | 标题 | string | 否   | 查看更多  |

+ setFooter

  设置底部html

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | footer | html | string | 是   |   |

+ setFooterExtraClass

  指定底部html样式

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | footer_extra_class | css类名 |  string  | 是   |   |


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

### Tab
可设置多个标签页的组件

用法:
```php
// 参数为背景主题色，默认为primary，见主题颜色说明
$tab = new Tab('success');

// 第一个参数为tab项目的标题
// 第二个参数为tab项目的html内容，或者是实现了__toString魔术函数的对象
// 第三个参数为tab项目标题的提示，默认为空
$tab->addTab('title', 'body', 'tips');

// 多个tab则实现多个addTab方法
$tab->addTab('divider', new DividerBuilder('222'));
```

### ListBox
设置列表组件

示例:

```php
$list_box = new \AdminLTE\Widgets\ListBox\ListBox();

// 获取需要展示的数据
$list = [["id" => 1,"title" => "title","amount" => 100,"summary"=>"summary","date"=>date("Y-m-d", time())]];

foreach ($list as $v){
    $item = new \AdminLTE\Widgets\ListBox\ListItem();
    // 设置标题及字体颜色
    $item->setTitle($v['title'],"primary");
    // 设置标题右边标签项及其背景颜色
    $item->addRightTag("$".$v['amount'],"success");
    // 设置描述项    
    $item->addColumn($v['summary']);
    $item->addColumn($v['date']);
    // 设置点击标题跳转链接    
    $item->setUrl(U("admin/review/detail",['id'=>$v['id']]));
    // 添加列表项，为\AdminLTE\Widgets\UlListCard\LiItem 对象
    $list_box->addListItem($item);
}

echo (new \AdminLTE\Widgets\Card($list_box,"待处理数据","danger"))->addFooterMore(U("admin/review/index"));
```

效果图

![image](https://user-images.githubusercontent.com/35066497/134834656-30d472d0-39df-4074-b830-a5c351b3df99.png)

函数说明
+ addListItem

  添加列表项，为\AdminLTE\Widgets\ListBox\ListItem 对象

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | item | \AdminLTE\Widgets\ListBox\ListItem 对象 | object | 是   |   |


### ListItem
列表项，与 \AdminLTE\Widgets\ListBox\ListBox 搭配使用

函数说明
+ setTitle

  设置标题及其字体颜色，默认为primary，见主题颜色说明

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | title | 标题 | string | 是   |   |
  | title_color | 字体颜色 |  string | 否   | primary  |
  
+ setUrl
  
  指定点击标题跳转链接

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | url | 跳转链接 | string | 是   |   |
  
+ addRightTag

  设置标题右边标签项及其背景颜色，默认为primary

  bg可选值：primary，secondary，success， info， warning， danger， light， dark

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | value | 标签名称 | string | 是   |   |
  | bg | 背景颜色 |  string |否   | primary |
  
+ addColumn

  添加描述项

  | 参数     | 说明                           | 类型 | 必填 | 默认值 |
  | :------- | :----------------------------- | ---- | ---- | :----- |
  | column | 描述内容 | string | 是   |   |


## 背景主题色
<font color='#17a2b8'>info #17a2b8</font>

<font color='#28a745'>success #28a745</font>

<font color='#ffc107'>warning #ffc107</font>

<font color='#dc3545'>danger #dc3545</font>

<font color='#6c757d'>secondary #6c757d</font>

<font color='#007bff'>primary #007bff</font>

<font color='#000000'>black #000000</font>

<font color='#343a40'>graydark #343a40</font>

<font color='#6c757d'>gray #6c757d</font>

<font color='#f8f9fa'>light #f8f9fa</font>

<font color='#6610f2'>indigo #6610f2</font>

<font color='#3c8dbc'>lightblue #3c8dbc</font>

<font color='#001f3f'>navy #001f3f</font>

<font color='#605ca8'>purple #605ca8</font>

<font color='#f012be'>fuchsia #f012be</font>

<font color='#e83e8c'>pink #e83e8c</font>

<font color='#d81b60'>maroon #d81b60</font>

<font color='#01ff70'>lime #01ff70</font>

<font color='#ff851b'>orange #ff851b</font>

<font color='#20c997'>teal #20c997</font>

<font color='#3d9970'>olive #3d9970</font>

#### 效果图 
![image](https://user-images.githubusercontent.com/35066497/90729026-7d4a2780-e2f8-11ea-9fa7-a77735e0eb33.png)