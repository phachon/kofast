/**
 * 树状类实现
 * 依赖 jquery treeview 插件
 *  使用示例:
var data = [];

data.push({id : '1', name : '一级分类1', value : '1', parent : '0',  operate: ' [<a href="/index.php/department/edit/department_id:1">编辑</a> | <a href="/index.php/department/delete/department_id:1" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '2', name : '二级分类', value : '2', parent : '1', operate: ' [<a href="/index.php/department/edit/department_id:2">编辑</a> | <a href="/index.php/department/delete/department_id:2" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '3', name : '三级分类', value : '3', parent : '2', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '4', name : '四级分类', value : '4', parent : '3', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});

data.push({id : '5', name : '一级分类2', value : '5', parent : '0', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '6', name : '二级分类', value : '6', parent : '5', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});

data.push({id : '7', name : '一级分类3', value : '7', parent : '6', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '8', name : '二级分类', value : '8', parent : '0', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});

data.push({id : '9', name : '一级分类4', value : '9', parent : '8', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});
data.push({id : '10', name : '二级分类 ', value : '10', parent : '9', operate: ' [<a href="/index.php/department/edit/department_id:3">编辑</a> | <a href="/index.php/department/delete/department_id:3" onclick="Common.confirm(\'确定删除吗？\');">删除</a>]'});

var t = new Tree('demo', data);
t.display('1');

 */

function Tree(container, data) {
	this.container = container;
	this.data = data;
	this.level = 1;
	this.currentLevel = 0;
}

Tree.prototype = {
	/**
	 * 获取树状HTML代码
	 */
	getHtml : function(parent) {
		var data = this.data;
		var length = data.length;
		var html = '';
		var childHtml = '';
		
		this.currentLevel++;
		
		for(var i = 0; i < length; i++) {
			if(data[i].parent != parent) {
				continue;
			}
			
			if(this.currentLevel >= this.level) {
				html += '<li><span>' + data[i].name + data[i].operate + '</span>';
			} else {
				//html += '<li>' + data[i].name + data[i].operate;
			}
			
			childHtml = this.getHtml(data[i].id);
			
			if(childHtml) {
				html += '<ul>' + childHtml + '</ul>';
			}
			html += '</li>';
		}
		
		this.currentLevel--;
		
		return html;
	},
	
	/**
	 * 展示某一层级的树
	 */
	display : function(level) {
		this.level = level < 1 ? 1 : level;
		$('#' + this.container).empty();
		
		var html = this.getHtml(0);
		
		$('#' + this.container).html(html);
		
		//阻止链接的click 事件冒泡
		$('#' + this.container + ' a').bind('click', function(event) {
			event.stopPropagation();
		});
		
		$("#" + this.container).treeview({
			animated: 'fast',
			persist: 'location',
			//cookieId: 'ntree',
			collapsed: true
		});
	}
};

