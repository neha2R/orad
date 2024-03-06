<html>
   <head>
      <title>Show Payment Page</title>
   </head>
   <body>
      <center>
         <h1>Please do not refresh this page...</h1>
      </center>
      <form method="post" action="https://securegw.paytm.in/theia/api/v1/showPaymentPage?mid=JODfTl60459964583598&orderId={{$orderid}}" name="paytm">
         <table border="1">
            <tbody>
               <input type="hidden" name="mid" value="JODfTl60459964583598">
               <input type="hidden" name="orderId" value="{{$orderid}}">
               <input type="hidden" name="txnToken" value="{{$token}}">
            </tbody>
         </table>
         <script type="text/javascript"> document.paytm.submit(); </script>
      </form>
   </body>
</html>