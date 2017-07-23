$(function() {
	$("#valor").maskMoney({allowNegative: true, showSymbol:false, thousands:'.', decimal:','});
	$("#valorcredito").maskMoney({showSymbol:false, thousands:'.', decimal:','});
	$("#valordebito").maskMoney({prefix:'-', thousands:'.', decimal:',', symbolStay: true});
	$("#valordebitoclinica").maskMoney({prefix:'-', thousands:'.', decimal:',', symbolStay: true});
	$("#valorrepassadodinheiro").maskMoney({allowNegative: false, showSymbol:false, thousands:'.', decimal:','});
	$("#valorrepassadocheque").maskMoney({allowNegative: false, showSymbol:false, thousands:'.', decimal:','});
	$("#valorclinicadinheiro").maskMoney({allowNegative: false, showSymbol:false, thousands:'.', decimal:','});
	$("#valorclinicacheque").maskMoney({allowNegative: false, showSymbol:false, thousands:'.', decimal:','});
	$("#valoraporte").maskMoney({allowNegative: false, showSymbol:false, thousands:'.', decimal:','});
	$("#taxa").maskMoney({showSymbol:false, thousands:'.', decimal:','});
});