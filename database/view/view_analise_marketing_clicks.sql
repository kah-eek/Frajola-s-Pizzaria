/*
	VIEW PARA MOSTRAR SOMENTE DADOS MAIS RELEVANTES PARA ANALISE DE MARKETING
*/
CREATE VIEW view_analise_marketing_clicks AS SELECT v_mp.idProduto, v_mp.titulo, v_mp.preco, v_mp.avaliacao, prd.click 
FROM view_mostrar_produtos AS v_mp 
INNER JOIN tbl_produto AS prd ON prd.idProduto = v_mp.idProduto
ORDER BY click DESC;

SELECT * FROM view_analise_marketing_clicks;