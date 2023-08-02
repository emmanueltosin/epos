
function generateChat(all){
	var ctx = document.getElementById("basiclinechart");
	var barchart1 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: all.labels,
			datasets:all.datasets
		}
	});
}


generateChat(all);

