/*
Esta inspirada en: https://davidwalsh.name/highlight-table-columns
*/
window.addEvent('domready',function(){
	/* METHOD 2: Better */
	var table = document.id('planificacion');
	var rows = table.getElements('tr');
	//for every row...
	rows.each(function(tr,trCount){
		//for every cell...
		tr.getElements('td').each(function(td,tdCount) {
			//remember column and column items
			var column = 'col-' + tdCount;
			var friends = 'td.' + column;
			//add td's column class
			td.addClass(column);
			//add the cell and column event listeners
			td.addEvents({
				'mouseenter': function(){
					$$(friends).erase(td).addClass('column-hover');
					td.addClass('cell-hover');
				},
				'mouseleave': function() {
					$$(friends).erase(td).removeClass('column-hover');
					td.removeClass('cell-hover');
				}
			});
		});
		tr.getElements('th').each(function(td,tdCount) {
			//remember column and column items
			var column = 'col-' + tdCount;
			var friends = 'td.' + column;
			//add td's column class
			td.addClass(column);
			//add the cell and column event listeners
			td.addEvents({
				'mouseenter': function(){
					$$(friends).erase(td).addClass('column-hover');
					td.addClass('cell-hover');
				},
				'mouseleave': function() {
					$$(friends).erase(td).removeClass('column-hover');
					td.removeClass('cell-hover');
				}
			});
		});
	});
});