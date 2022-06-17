<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonMedicalData;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonMedicalData
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonMedicalData extends BasePersonMedicalData
{
    //region Columns
    /**
     * @var string|null
     *
     * @ORM\Column(name="allergy", type="text", nullable=true)
     */
    private $allergy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disease", type="text", nullable=true)
     */
    private $disease;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prescription_drugs", type="text", nullable=true)
     */
    private $prescriptionDrugs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disability", type="text", nullable=true)
     */
    private $disability;

    /**
     * @var string|null
     *
     * @ORM\Column(name="health_plan", type="string", length=255, nullable=true)
     */
    private $healthPlan;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reference_hospital", type="string", length=255, nullable=true)
     */
    private $referenceHospital;

    /**
     * @var int
     *
     * @ORM\Column(name="blood_type", type="integer", nullable=false)
     */
    private $bloodType = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarks", type="text", nullable=true)
     */
    private $remarks;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;
    //endregion

    //region Getters
    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getDisease(): ?string
    {
        return $this->disease;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getPrescriptionDrugs(): ?string
    {
        return $this->prescriptionDrugs;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getDisability(): ?string
    {
        return $this->disability;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getHealthPlan(): ?string
    {
        return $this->healthPlan;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getReferenceHospital(): ?string
    {
        return $this->referenceHospital;
    }

    /**
     * @return int
     * @Groups({"read-person_medical_data"})
     */
    public function getBloodType(): int
    {
        return $this->bloodType;
    }

    /**
     * @return string|null
     * @Groups({"read-person_medical_data"})
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * @return Person
     * @Groups({"read-person_medical_data-relations","read-person_medical_data-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $allergy
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setAllergy(?string $allergy): PersonMedicalData
    {
        $this->allergy = $allergy;
        return $this;
    }

    /**
     * @param string|null $disease
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setDisease(?string $disease): PersonMedicalData
    {
        $this->disease = $disease;
        return $this;
    }

    /**
     * @param string|null $prescriptionDrugs
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setPrescriptionDrugs(?string $prescriptionDrugs): PersonMedicalData
    {
        $this->prescriptionDrugs = $prescriptionDrugs;
        return $this;
    }

    /**
     * @param string|null $disability
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setDisability(?string $disability): PersonMedicalData
    {
        $this->disability = $disability;
        return $this;
    }

    /**
     * @param string|null $healthPlan
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setHealthPlan(?string $healthPlan): PersonMedicalData
    {
        $this->healthPlan = $healthPlan;
        return $this;
    }

    /**
     * @param string|null $referenceHospital
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setReferenceHospital(?string $referenceHospital): PersonMedicalData
    {
        $this->referenceHospital = $referenceHospital;
        return $this;
    }

    /**
     * @param int $bloodType
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setBloodType(int $bloodType): PersonMedicalData
    {
        $this->bloodType = $bloodType;
        return $this;
    }

    /**
     * @param string|null $remarks
     * @return PersonMedicalData
     * @Groups({"write-person_medical_data"})
     */
    public function setRemarks(?string $remarks): PersonMedicalData
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonMedicalData
     */
    public function setPerson(Person $person): PersonMedicalData
    {
        $this->person = $person;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
