desShortcodeMeta={
	attributes:[
		{
			label:"Pricing Tables",
			id:"pricing_table",
			help:"The Pricing Table to be imported. <br>To create a new Pricing Table go to <b>Pricing Tables > Add New</b>.<br> You need to have this plugin installed and active.", 
			controlType:"pricing-tables-control"
		}
	],
	disablePreview:true,
	customMakeShortcode: function(b){
		var a=b.data;
		return '[pricing_table name="' + b.pricing_table + '"]';
	}
};
