/*
	CALCULAR A PORCENTAGEM DE CLICKS CORREPSONDENTE AO TOTAL DE CLICKS DE TODOS OS PRODUTOS
    
    maxClicksNumber = NUMERO DE CLICKS DO PRODUTO A SER ADQUIRIDO SUA PORCENTAGEM
*/
DELIMITER >>

CREATE PROCEDURE sp_obter_margem_click_produtos(IN maxClicksNumber INT, OUT parcent FLOAT)
	BEGIN
		
        DECLARE maxClick INT;
        DECLARE percent INT;
        
        SET maxClick = (SELECT MAX(click) FROM view_analise_marketing_clicks);
        
        SET parcent = TRUNCATE(((maxClick*maxClicksNumber)/100), 2);
        
    END >>

DELIMITER ;
/* *********************************************************************************************** */


/*
	TESTE DA STORED PROCEDURE
*/
CALL sp_obter_margem_click_produtos(28, @parcent);
SELECT @parcent;

/* ***************************************** */

/*
	OBTEM SOMENTE O REGISTRO QUE POSSUI A MAIOR QUANTIDADE DE CLICKS
*/
SELECT * FROM view_analise_marketing_clicks WHERE click = (SELECT MAX(click) FROM view_analise_marketing_clicks);