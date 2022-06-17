<?php


namespace App\Doctrine\Traits;


trait DefaultEntity
{
    use GuidEntity;
    use BlamableEntity;
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
