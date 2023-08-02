function generateChat(all){
	var ctx = document.getElementById("barchart1");
	var barchart1 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: all.labels,
			datasets:all.datasets
		}
	});
}

generateChat(all);