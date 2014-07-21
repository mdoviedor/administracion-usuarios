<?php

namespace Aseduis\EgresadosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EgresadoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EgresadoRepository extends EntityRepository {
    /*
     * Busqueda filtrada de egresados
     */

    public function busquedaFiltros($identificacion, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $desde, $hasta, $programaacademico, $limite) {

        return $this->getEntityManager()
                        ->createQuery(
                                "SELECT e FROM AseduisEgresadosBundle:Egresado e JOIN AseduisEgresadosBundle:EgresadoProgramaacademico ep WITH e.idegresado = ep.egresado AND "
                                . "((e.identificacion = :identificacion) OR"
                                . "(ep.programaacademico = :programaacademico) OR"
                                . " (e.primernombre LIKE :primernombre) OR"
                                . " (e.primernombre LIKE :primernombre AND e.primerapellido LIKE :primerapellido) OR"
                                . " (e.primernombre LIKE :primernombre AND e.segundonombre LIKE :segundonombre AND e.primerapellido LIKE :primerapellido) OR"
                                . " (e.primernombre LIKE :primernombre AND e.primerapellido LIKE :primerapellido AND e.segundoapellido LIKE :segundoapellido) OR"
                                . " (e.primernombre LIKE :primernombre AND e.segundonombre LIKE :segundonombre AND e.primerapellido LIKE :primerapellido AND e.segundoapellido LIKE :segundoapellido) OR"
                                . " (ep.fechagrado BETWEEN :desde AND :hasta))"
                        )
                        ->setParameter('primernombre', '%' . $primernombre . '%')
                        ->setParameter('segundonombre', '%' . $segundonombre . '%')
                        ->setParameter('primerapellido', '%' . $primerapellido . '%')
                        ->setParameter('segundoapellido', '%' . $segundoapellido . '%')
                        ->setParameter('identificacion', $identificacion)
                        ->setParameter('programaacademico', $programaacademico)
                        ->setParameter('desde', new \DateTime($desde))
                        ->setParameter('hasta', new \DateTime($hasta))
                        ->setMaxResults($limite)//maneja el numero de resultados que se visualizaran
                        ->getResult();
    }

}
