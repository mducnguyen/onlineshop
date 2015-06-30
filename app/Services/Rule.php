<?php
/**
 * Created by PhpStorm.
 * User: DucNguyenMinh
 * Date: 6/23/15
 * Time: 11:42 PM
 */
namespace App\Services;

class Rule
{

    /**
     * @var ItemSet $fi
     */
    private $fi;

    /**
     * @var ItemSet $l
     */
    private $l;

    /**
     * @var ItemSet $fi_l
     */
    private $fi_l;

    /**
     * Confidence score
     * @var float
     */
    private $confidence;

    /**
     * @param ItemSet $fi
     * @param ItemSet $l
     */
    function __construct(ItemSet $fi, ItemSet $l)
    {
        $this->fi   = $fi;
        $this->l    = $l;
        $this->fi_l = $fi->getComplementItemSet($l);
        $this->confidence = null;
    }

    public function getConfidence()
    {
        if ($this->confidence == null) {
            $this->confidence = $this->fi->getSupport() / $this->l->getSupport();
        }

        return $this->confidence;
    }

    /**
     * @return ItemSet
     */
    public function getLSet()
    {
        return $this->l;
    }

    /**
     * @return ItemSet
     */
    public function getRSet()
    {
        return $this->fi_l;
    }
}
