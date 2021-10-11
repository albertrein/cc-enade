from selenium import webdriver
import time
import json
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
import urllib


driver = webdriver.Chrome(ChromeDriverManager().install())
wait = WebDriverWait(driver, 50)

lista_links = ['http://ccenade.great-site.net/imagens_questoes/73.PNG',
'http://ccenade.great-site.net/imagens_questoes/72.PNG',
'http://ccenade.great-site.net/imagens_questoes/71.PNG',
'http://ccenade.great-site.net/imagens_questoes/70.PNG',
'http://ccenade.great-site.net/imagens_questoes/69.PNG',
'http://ccenade.great-site.net/imagens_questoes/68.PNG',
'http://ccenade.great-site.net/imagens_questoes/67.PNG',
'http://ccenade.great-site.net/imagens_questoes/66.PNG',
'http://ccenade.great-site.net/imagens_questoes/65.PNG',
'http://ccenade.great-site.net/imagens_questoes/64.PNG',
'http://ccenade.great-site.net/imagens_questoes/63.PNG',
'http://ccenade.great-site.net/imagens_questoes/61.PNG',
'http://ccenade.great-site.net/imagens_questoes/60.PNG',
'http://ccenade.great-site.net/imagens_questoes/59.PNG',
'http://ccenade.great-site.net/imagens_questoes/58.PNG',
'http://ccenade.great-site.net/imagens_questoes/57.PNG',
'http://ccenade.great-site.net/imagens_questoes/56.PNG',
'http://ccenade.great-site.net/imagens_questoes/55.PNG',
'http://ccenade.great-site.net/imagens_questoes/53.PNG',
'http://ccenade.great-site.net/imagens_questoes/52.PNG',
'http://ccenade.great-site.net/imagens_questoes/51.PNG',
'http://ccenade.great-site.net/imagens_questoes/50.PNG',
'http://ccenade.great-site.net/imagens_questoes/49.PNG',
'http://ccenade.great-site.net/imagens_questoes/48.PNG',
'http://ccenade.great-site.net/imagens_questoes/47.PNG',
'http://ccenade.great-site.net/imagens_questoes/46.PNG',
'http://ccenade.great-site.net/imagens_questoes/45.PNG',
'http://ccenade.great-site.net/imagens_questoes/44.PNG',
'http://ccenade.great-site.net/imagens_questoes/43.PNG',
'http://ccenade.great-site.net/imagens_questoes/42.PNG',
'http://ccenade.great-site.net/imagens_questoes/41.PNG',
'http://ccenade.great-site.net/imagens_questoes/39.PNG',
'http://ccenade.great-site.net/imagens_questoes/38.PNG',
'http://ccenade.great-site.net/imagens_questoes/37.PNG',
'http://ccenade.great-site.net/imagens_questoes/36.PNG',
'http://ccenade.great-site.net/imagens_questoes/35.PNG',
'http://ccenade.great-site.net/imagens_questoes/34.PNG',
'http://ccenade.great-site.net/imagens_questoes/33.PNG',
'http://ccenade.great-site.net/imagens_questoes/32.PNG',
'http://ccenade.great-site.net/imagens_questoes/31.PNG',
'http://ccenade.great-site.net/imagens_questoes/30.PNG',
'http://ccenade.great-site.net/imagens_questoes/29.PNG',
'http://ccenade.great-site.net/imagens_questoes/28.PNG',
'http://ccenade.great-site.net/imagens_questoes/27.PNG',
'http://ccenade.great-site.net/imagens_questoes/26.PNG',
'http://ccenade.great-site.net/imagens_questoes/25.PNG',
'http://ccenade.great-site.net/imagens_questoes/24.PNG',
'http://ccenade.great-site.net/imagens_questoes/23.PNG',
'http://ccenade.great-site.net/imagens_questoes/22.PNG',
'http://ccenade.great-site.net/imagens_questoes/21.PNG',
'http://ccenade.great-site.net/imagens_questoes/20.PNG',
'http://ccenade.great-site.net/imagens_questoes/19.PNG',
'http://ccenade.great-site.net/imagens_questoes/18.PNG',
'http://ccenade.great-site.net/imagens_questoes/17.PNG',
'http://ccenade.great-site.net/imagens_questoes/16.PNG',
'http://ccenade.great-site.net/imagens_questoes/15.PNG',
'http://ccenade.great-site.net/imagens_questoes/14.png']


for lista in lista_links:
	driver.get(lista)
	nome_arquivo = lista[-6:].lower()
	time.sleep(10)
	with open(nome_arquivo, 'wb') as file:
		elemento = driver.find_element_by_xpath('/html/body/img')
		file.write(elemento.screenshot_as_png)


driver.close()