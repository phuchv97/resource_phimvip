$('#keyword').autocomplete({
    serviceUrl: '/ajax/autocomplete/9999',
	type: 'POST',
	dataType:'json',
	formatResult:function(suggestion,currentValue){
		return suggestion.html
	},
    onSelect: function (suggestion) {
        window.location.href = suggestion.data;
    },
	transformResult: function(response) {
        return {
            suggestions: $.map(response.suggestions, function(dataItem) {
				var templatePart="<a class=\"clearfix\" href=\"__LINK__\">\r\n                                    <div class=\"thumbnail\">\r\n                                        <img src=\"__IMAGE__\" />\r\n                                    </div>\r\n                                    <div class=\"meta-item\">\r\n                                        <h3 class=\"name-1\">\r\n                                            __NAME__\r\n                                        <\/h3>\r\n                                        <h4 class=\"name-2\">__NAME_ORIGINAL__</h4>\r\n                                    </div>\r\n </a>\r\n";
				templatePart=templatePart.split("__LINK__").join(dataItem.link);
				templatePart=templatePart.split("__NAME_ORIGINAL__").join(dataItem.namereal);
				templatePart=templatePart.split("__NAME__").join(dataItem.name);
				templatePart=templatePart.split("__IMAGE__").join(dataItem.image);
                return { value:dataItem.name,html:templatePart,data:dataItem.link};
            })
        }
    }
});
