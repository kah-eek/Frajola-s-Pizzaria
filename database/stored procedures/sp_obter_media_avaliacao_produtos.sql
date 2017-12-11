/*
	OBTEM A MEDIA DAS CLASSIFICACOES DE TODOS OS PRODUTOS ARMAZENADO NO BANCO DE DADOS
    
	mediaAvaliacao - RETORNA O NUMERO DA MEDIA DESTA AVALIACAO
*/

DELIMITER >>

CREATE PROCEDURE sp_obter_media_avaliacao_produtos(OUT mediaAvaliacao FLOAT)
	BEGIN
    
		SET mediaAvaliacao = (SELECT AVG(avaliacao) FROM tbl_avaliacao);
    
    END>>

DELIMITER ;

/* TESTE DA PROCEDURE */
CALL sp_obter_media_avaliacao_produtos(@average);
SELECT @average;