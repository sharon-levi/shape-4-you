function ValidateForm()
	{
		
		var id = document.Form.id;
		
		if(validateId(id) === 1){
			window.alert(`teudat zehut is true`);
			return true;
		}
		
		window.alert(`WRONG`);
		return false;
	}

function validateId(str){
    // DEFINE RETURN VALUES
    var R_ELEGAL_INPUT = -1;
    var R_NOT_VALID = -2;
    var R_VALID = 1;
    
   //INPUT VALIDATION

   // Just in case -> convert to string
   var IDnum = String(str);

   // Validate correct input
   if ((IDnum.length > 9) || (IDnum.length < 5))
      return R_ELEGAL_INPUT;
   if (isNaN(IDnum))
      return R_ELEGAL_INPUT;

   // The number is too short - add leading 0000
   if (IDnum.length < 9)
   {
      while(IDnum.length < 9)
      {
         IDnum = '0' + IDnum;         
      }
   }

   // CHECK THE ID NUMBER
   var mone = 0, incNum;
   for (var i=0; i < 9; i++)
   {
      incNum = Number(IDnum.charAt(i));
      incNum *= (i%2)+1;
      if (incNum > 9)
         incNum -= 9;
      mone += incNum;
   }
   if (mone%10 === 0)
      return R_VALID;
   else
      return R_NOT_VALID;
}

function valid() {
    alert('done');
}

console.log('test')