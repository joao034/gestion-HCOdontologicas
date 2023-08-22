DELIMITER $$
CREATE OR REPLACE TRIGGER `sumar_total_presupuesto` AFTER INSERT ON `odontograma_detalle`
 FOR EACH ROW BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
        
    -- Verificar el estado antes de actualizar el total
    IF NEW.estado = 'necesario' OR NEW.estado = 'presupuesto' THEN
        -- Obtener el precio del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = NEW.tratamiento_id;

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total + precio_tratamiento
        WHERE id = NEW.odontograma_cabecera_id;
    END IF;
END
$$

DELIMITER $$
CREATE OR REPLACE TRIGGER `restar_total_presupuesto_update` AFTER UPDATE ON `odontograma_detalle`
 FOR EACH ROW BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
    DECLARE dif_precio FLOAT;

    SET dif_precio = OLD.precio - NEW.precio;

    IF NEW.precio > OLD.precio THEN
       UPDATE odontograma_cabecera
       SET total = total + (dif_precio * (-1))
       WHERE id = NEW.odontograma_cabecera_id; 
    
    ELSEIF NEW.precio < OLD.precio THEN
        UPDATE odontograma_cabecera
        SET total = total - dif_precio
        WHERE id = NEW.odontograma_cabecera_id;
    END IF;
        
    -- Verificar el estado antes de actualizar el total
    IF NEW.estado = 'fuera_presupuesto' THEN

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total - OLD.precio
        WHERE id = OLD.odontograma_cabecera_id;
    END IF;
END
$$

DELIMITER $$
CREATE OR REPLACE TRIGGER `restar_total_presupuesto_delete` AFTER DELETE ON `odontograma_detalle`
 FOR EACH ROW BEGIN

     IF OLD.estado = 'necesario' THEN   
        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total - OLD.precio
        WHERE id = OLD.odontograma_cabecera_id;
     END IF;
END
$$

//eliminar un TRIGGER
DROP TRIGGER IF EXISTS `restar_total_presupuesto_update`;