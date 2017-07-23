$(document).ready(function() {
    
    var funcaoFechaTodos = function(){
    	$(".lancamento-comum").hide();
    	$(".lancamento-credito").hide();
    	$(".lancamento-saida").hide();
        $(".lancamento-saida-clinica").hide();
    }

    var funcaoFechaAcerto = function(){
        $(".lancamento-acerto").hide();
        $("#fazerAcerto").toggle();
    }

    $("#botaoCinza").click(function(){
    	funcaoFechaTodos();
    	$(".lancamento-comum").toggle();
    });
    
    $("#botaoVerde").click(function(){
    	funcaoFechaTodos();
    	$(".lancamento-credito").toggle();
    });

    $("#botaoVermelho").click(function(){
    	funcaoFechaTodos();
    	$(".lancamento-saida").toggle();
    });

    $("#botaoVermelhoClinica").click(function(){
        funcaoFechaTodos();
        $(".lancamento-saida-clinica").toggle();
    });

	$(".botaoFechar").click(function(){
    	funcaoFechaTodos();
    });

    $("#fazerAcerto").click(function(){
        $("#fazerAcerto").hide();
        $(".lancamento-acerto").toggle();
    }); 

    $(".botaoFecharAcerto").click(function(){
        funcaoFechaAcerto();
    });

    $("#fazerLiquidez").click(function(){
        $("#fazerLiquidez").hide();
        $("#campoLiquidez").toggle();
    });

    $("#botaoFecharLiquidez").click(function(){
        $("#campoLiquidez").hide();
        $("#fazerLiquidez").toggle();
    });
    
});