var isFee = $.session.get('feeuser');
if(isFee){
    history.back(-1);
}