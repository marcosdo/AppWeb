/*
Esta inspirada en: https://davidwalsh.name/highlight-table-columns
*/
window.addEvent('domready',function(){
	var table = document.id('planificacion');
	var rows = table.getElements('tr');
	rows.each(function(tr,trCount){
		tr.getElements('td').each(function(td,tdCount) {
			var column = 'col-' + tdCount;
			var friends = 'td.' + column;
			td.addClass(column);
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

$(".message a").click(function () {
	$(".login").animate({ height: "toggle", opacity: "toggle" }, "slow");
});