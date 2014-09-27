
(function($,Edge,compId){var Composition=Edge.Composition,Symbol=Edge.Symbol;
//Edge symbol: 'stage'
(function(symbolName){Symbol.bindElementAction(compId,symbolName,"${_Stage}","click",function(sym,e){sym.play();});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",1000,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_large_frame_pic-01}","click",function(sym,e){sym.play();});
//Edge binding end
})("stage");
//Edge symbol end:'stage'
})(jQuery,AdobeEdge,"EDGE-138297732");