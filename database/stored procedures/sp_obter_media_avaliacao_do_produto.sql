/*
	OBTEM A MEDIA DE CLASSIFICAO DE UM PRODUTO SE BASEANDO EM TODAS AS SUAS CLASSIFICACOES DISPONIVEIS NO BANCO DE DADOS
    
    _idProduto - ID DO PRODUTO A OBTER SUA MEDIA DE CLASSIFICACAO
    mediaProduto - MEDIA CALCULADA PARA O PRODUTO INFORMADO
*/

DELIMITER >>

	CREATE PROCEDURE sp_obter_media_avaliacao_do_produto(IN _idProduto INT, OUT mediaProduto FLOAT)
		BEGIN
        
        SET mediaProduto = (SELECT AVG(avaliacao) FROM tbl_avaliacao WHERE idProduto = _idProduto);
        
        END>>
    
DELIMITER ;

CALL sp_obter_media_avaliacao_do_produto(9, @mediaProduto);
SELECT @mediaProduto;