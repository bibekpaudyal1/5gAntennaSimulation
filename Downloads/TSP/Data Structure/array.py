#use of array 
def find_stock_price(stock_prices):
   for i in range(len(stock_prices)):
      if stock_prices[i] == 302:
         data = stock_prices[i] 
         return data  
      

stock_prices = [200,300,302,405,600]
results = find_stock_price(stock_prices)
print(results)

stock_prices.append(340)
stock_prices.insert(2,450)
#Question no 1 

