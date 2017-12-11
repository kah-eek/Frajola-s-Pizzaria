CREATE VIEW view_mostrar_subcategorias_e_categorias AS SELECT sbc.idSubcategoria, sbc.idCategoria, sbc.subcategoria,  ctg.categoria FROM tbl_subcategoria AS sbc
INNER JOIN tbl_categoria AS ctg ON sbc.idCategoria = ctg.idCategoria;

SELECT * FROM view_mostrar_subcategorias_e_categorias;