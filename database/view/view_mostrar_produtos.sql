ALTER VIEW view_mostrar_produtos AS SELECT prd.idProduto, prd.titulo, prd.preco, prd.descricao, prd.detalhes, prd.imagemProduto, prd.idSubcategoria, prd.ativo,sbc.subcategoria, ctg.idCategoria, ctg.categoria, AVG(avl.avaliacao) AS avaliacao, avl.idAvaliacao
FROM tbl_produto AS prd
INNER JOIN  tbl_avaliacao AS avl  ON avl.idProduto = prd.idProduto
INNER JOIN tbl_subcategoria As sbc ON sbc.idSubcategoria = prd.idSubcategoria
INNER JOIN tbl_categoria AS ctg ON ctg.idCategoria = sbc.idCategoria
GROUP BY idProduto;

SELECT * FROM view_mostrar_produtos;