
  <!doctype html>
  <html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
  </head>
  <body>
      <div class="p-20 h-screen w-screen flex flex-col-reverse md:flex-row items-center justify-center bg-gray-200">
          <div class="content text-3xl text-left md:text-left p-y-2">
          </div>
          <div class="container mx-auto flex flex-col items-center">
            <form class="shadow-lg w-80 p-4 flex flex-col bg-white rounded-lg" method="GET" action="/testpaytm">
              <img src="/oradlogo.png"  />
              
              <input type="text" placeholder="Email or Phone Number"  disabled value="Basic English Course" class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <input type="text" placeholder="Email or Phone Number"  disabled value="One-on-one" class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <input type="text" placeholder="Pasword" name="amount" readonly value="2000" class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <input type="text" placeholder="Pasword" readonly value="Class Duration 30 Days" class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <input type="text" placeholder="Email Address" value="rmodi2407@gmail.com"   class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <input type="text" placeholder="Mobile" value="9024829041"   class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500" />
              <button class="w-full bg-blue-500 text-white p-3 rounded-lg font-semibold text-lg">Proceed to Pay</button>
              <img src="/paymentlogo1.jpeg"  />
              
            </form>
           
          </div>
        </div>
     
  </body>
  </html>