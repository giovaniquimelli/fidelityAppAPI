<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentTurnstileTecnibra;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentTurnstileTecnibra
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentTurnstileTecnibra extends BaseEquipmentTurnstileTecnibra
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name_interno", type="string", length=255, nullable=true)
     */
    private $nameInterno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="type_comunicacao", type="integer", nullable=true, options={"comment"="serial / tcpip"})
     */
    private $typeComunicacao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="type_equipamento", type="integer", nullable=true, options={"comment"="CATRACA_IHM, CATRACA_IHM2, TERMINAL_IHM, TOTEM_IHM"})
     */
    private $typeEquipamento;

    /**
     * @var int|null
     *
     * @ORM\Column(name="type_fechadura", type="integer", nullable=true, options={"comment"="eletromecanica, eletromagnetica"})
     */
    private $typeFechadura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="servidor_ip", type="string", length=255, nullable=true)
     */
    private $servidorIp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="servidor_porta", type="integer", nullable=true)
     */
    private $servidorPorta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="terminal_ip", type="string", length=255, nullable=true)
     */
    private $terminalIp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="terminal_porta", type="integer", nullable=true)
     */
    private $terminalPorta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="terminal_porta_serial", type="string", length=255, nullable=true)
     */
    private $terminalPortaSerial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="terminal_senha", type="string", length=255, nullable=true)
     */
    private $terminalSenha;

    /**
     * @var int|null
     *
     * @ORM\Column(name="terminal_numero", type="integer", nullable=true)
     */
    private $terminalNumero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_virada_linha1", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemViradaLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_virada_linha2", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemViradaLinha2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_entrada_linha1", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemEntradaLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_entrada_linha2", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemEntradaLinha2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_saida_linha1", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemSaidaLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_saida_linha2", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemSaidaLinha2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_negado_linha1", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemNegadoLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_negado_linha2", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemNegadoLinha2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_bloqueado_linha1", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemBloqueadoLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensagem_bloqueado_linha2", type="string", length=16, nullable=true, options={"fixed"=true})
     */
    private $mensagemBloqueadoLinha2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sentido_entrada", type="integer", nullable=true)
     */
    private $sentidoEntrada;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitor_bio_habilitado", type="boolean", nullable=true)
     */
    private $leitorBioHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio_modo_identificacao", type="integer", nullable=true)
     */
    private $leitorBioModoIdentificacao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio_posicao", type="integer", nullable=true)
     */
    private $leitorBioPosicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitor_bio2_habilitado", type="boolean", nullable=true)
     */
    private $leitorBio2Habilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio2_posicao", type="integer", nullable=true)
     */
    private $leitorBio2Posicao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio2_pictograma_esquerdo", type="integer", nullable=true)
     */
    private $leitorBio2PictogramaEsquerdo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio2_pictograma_direito", type="integer", nullable=true)
     */
    private $leitorBio2PictogramaDireito;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leitor_bio2_modo_operacao", type="integer", nullable=true)
     */
    private $leitorBio2ModoOperacao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitor_bio2_consulta_lista_cadastral", type="boolean", nullable=true)
     */
    private $leitorBio2ConsultaListaCadastral = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitor_bio2_consulta_tabela_horarios", type="boolean", nullable=true)
     */
    private $leitorBio2ConsultaTabelaHorarios = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitor_bio2_consulta_sinaleiros", type="boolean", nullable=true)
     */
    private $leitorBio2ConsultaSinaleiros = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="teclado_habilitado", type="boolean", nullable=true)
     */
    private $tecladoHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="teclado_posicao", type="integer", nullable=true)
     */
    private $tecladoPosicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="barcode_habilitado", type="boolean", nullable=true)
     */
    private $barcodeHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="barcode_posicao", type="integer", nullable=true)
     */
    private $barcodePosicao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="barcode_formato", type="integer", nullable=true)
     */
    private $barcodeFormato;

    /**
     * @var int|null
     *
     * @ORM\Column(name="barcode_numero_digitos", type="integer", nullable=true)
     */
    private $barcodeNumeroDigitos;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="barcode2_habilitado", type="boolean", nullable=true)
     */
    private $barcode2Habilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="barcode2_posicao", type="integer", nullable=true)
     */
    private $barcode2Posicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rfid_habilitado", type="boolean", nullable=true)
     */
    private $rfidHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rfid_posicao", type="integer", nullable=true)
     */
    private $rfidPosicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rfid2_habilitado", type="boolean", nullable=true)
     */
    private $rfid2Habilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rfid2_posicao", type="integer", nullable=true)
     */
    private $rfid2Posicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cofre_coletor_habilitado", type="boolean", nullable=true)
     */
    private $cofreColetorHabilitado = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cofre_coletor_sensor_coleta_habilitado", type="boolean", nullable=true)
     */
    private $cofreColetorSensorColetaHabilitado = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cofre_burro_habilitado", type="boolean", nullable=true)
     */
    private $cofreBurroHabilitado = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cofre_totem", type="boolean", nullable=true)
     */
    private $cofreTotem = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="braco_giro_liberado", type="integer", nullable=true)
     */
    private $bracoGiroLiberado;

    /**
     * @var int|null
     *
     * @ORM\Column(name="braco_giro_liberado_posicao", type="integer", nullable=true)
     */
    private $bracoGiroLiberadoPosicao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="braco_offline_status", type="integer", nullable=true)
     */
    private $bracoOfflineStatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="braco_giro_timeout", type="integer", nullable=true)
     */
    private $bracoGiroTimeout;

    /**
     * @var int|null
     *
     * @ORM\Column(name="memoria_cheia_status", type="integer", nullable=true)
     */
    private $memoriaCheiaStatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="revista_grau", type="integer", nullable=true)
     */
    private $revistaGrau;

    /**
     * @var int|null
     *
     * @ORM\Column(name="revista_type", type="integer", nullable=true)
     */
    private $revistaType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="revista_timeout", type="integer", nullable=true)
     */
    private $revistaTimeout;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="contador_diplay_habilitado", type="boolean", nullable=true)
     */
    private $contadorDiplayHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="contador_display_posicao", type="integer", nullable=true)
     */
    private $contadorDisplayPosicao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="controle_fechadura_sensor_porta_principal_habilitado", type="boolean", nullable=true)
     */
    private $controleFechaduraSensorPortaPrincipalHabilitado = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="controle_fechadura_sensor_porta_secundaria_habilitado", type="boolean", nullable=true)
     */
    private $controleFechaduraSensorPortaSecundariaHabilitado = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="controle_fechadura_type_fechadura", type="integer", nullable=true)
     */
    private $controleFechaduraTypeFechadura;

    /**
     * @var int|null
     *
     * @ORM\Column(name="controle_fechadura_aviso_porta_aberta_timeout", type="integer", nullable=true)
     */
    private $controleFechaduraAvisoPortaAbertaTimeout;

    /**
     * @var int|null
     *
     * @ORM\Column(name="timeout_servidor", type="integer", nullable=true)
     */
    private $timeoutServidor;

    /**
     * @var Equipment
     *
     * @ORM\ManyToOne(targetEntity="Equipment")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $equipment;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getNameInterno(): ?string
    {
        return $this->nameInterno;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTypeComunicacao(): ?int
    {
        return $this->typeComunicacao;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTypeEquipamento(): ?int
    {
        return $this->typeEquipamento;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTypeFechadura(): ?int
    {
        return $this->typeFechadura;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getServidorIp(): ?string
    {
        return $this->servidorIp;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getServidorPorta(): ?int
    {
        return $this->servidorPorta;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTerminalIp(): ?string
    {
        return $this->terminalIp;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTerminalPorta(): ?int
    {
        return $this->terminalPorta;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTerminalPortaSerial(): ?string
    {
        return $this->terminalPortaSerial;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTerminalSenha(): ?string
    {
        return $this->terminalSenha;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTerminalNumero(): ?int
    {
        return $this->terminalNumero;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemViradaLinha1(): ?string
    {
        return $this->mensagemViradaLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemViradaLinha2(): ?string
    {
        return $this->mensagemViradaLinha2;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemEntradaLinha1(): ?string
    {
        return $this->mensagemEntradaLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemEntradaLinha2(): ?string
    {
        return $this->mensagemEntradaLinha2;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemSaidaLinha1(): ?string
    {
        return $this->mensagemSaidaLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemSaidaLinha2(): ?string
    {
        return $this->mensagemSaidaLinha2;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemNegadoLinha1(): ?string
    {
        return $this->mensagemNegadoLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemNegadoLinha2(): ?string
    {
        return $this->mensagemNegadoLinha2;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemBloqueadoLinha1(): ?string
    {
        return $this->mensagemBloqueadoLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMensagemBloqueadoLinha2(): ?string
    {
        return $this->mensagemBloqueadoLinha2;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getSentidoEntrada(): ?int
    {
        return $this->sentidoEntrada;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBioHabilitado(): ?bool
    {
        return $this->leitorBioHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBioModoIdentificacao(): ?int
    {
        return $this->leitorBioModoIdentificacao;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBioPosicao(): ?int
    {
        return $this->leitorBioPosicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2Habilitado(): ?bool
    {
        return $this->leitorBio2Habilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2Posicao(): ?int
    {
        return $this->leitorBio2Posicao;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2PictogramaEsquerdo(): ?int
    {
        return $this->leitorBio2PictogramaEsquerdo;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2PictogramaDireito(): ?int
    {
        return $this->leitorBio2PictogramaDireito;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2ModoOperacao(): ?int
    {
        return $this->leitorBio2ModoOperacao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2ConsultaListaCadastral(): ?bool
    {
        return $this->leitorBio2ConsultaListaCadastral;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2ConsultaTabelaHorarios(): ?bool
    {
        return $this->leitorBio2ConsultaTabelaHorarios;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getLeitorBio2ConsultaSinaleiros(): ?bool
    {
        return $this->leitorBio2ConsultaSinaleiros;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTecladoHabilitado(): ?bool
    {
        return $this->tecladoHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTecladoPosicao(): ?int
    {
        return $this->tecladoPosicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcodeHabilitado(): ?bool
    {
        return $this->barcodeHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcodePosicao(): ?int
    {
        return $this->barcodePosicao;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcodeFormato(): ?int
    {
        return $this->barcodeFormato;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcodeNumeroDigitos(): ?int
    {
        return $this->barcodeNumeroDigitos;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcode2Habilitado(): ?bool
    {
        return $this->barcode2Habilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBarcode2Posicao(): ?int
    {
        return $this->barcode2Posicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRfidHabilitado(): ?bool
    {
        return $this->rfidHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRfidPosicao(): ?int
    {
        return $this->rfidPosicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRfid2Habilitado(): ?bool
    {
        return $this->rfid2Habilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRfid2Posicao(): ?int
    {
        return $this->rfid2Posicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getCofreColetorHabilitado(): ?bool
    {
        return $this->cofreColetorHabilitado;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getCofreColetorSensorColetaHabilitado(): ?bool
    {
        return $this->cofreColetorSensorColetaHabilitado;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getCofreBurroHabilitado(): ?bool
    {
        return $this->cofreBurroHabilitado;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getCofreTotem(): ?bool
    {
        return $this->cofreTotem;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBracoGiroLiberado(): ?int
    {
        return $this->bracoGiroLiberado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBracoGiroLiberadoPosicao(): ?int
    {
        return $this->bracoGiroLiberadoPosicao;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBracoOfflineStatus(): ?int
    {
        return $this->bracoOfflineStatus;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getBracoGiroTimeout(): ?int
    {
        return $this->bracoGiroTimeout;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getMemoriaCheiaStatus(): ?int
    {
        return $this->memoriaCheiaStatus;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRevistaGrau(): ?int
    {
        return $this->revistaGrau;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRevistaType(): ?int
    {
        return $this->revistaType;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getRevistaTimeout(): ?int
    {
        return $this->revistaTimeout;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getContadorDiplayHabilitado(): ?bool
    {
        return $this->contadorDiplayHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getContadorDisplayPosicao(): ?int
    {
        return $this->contadorDisplayPosicao;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getControleFechaduraSensorPortaPrincipalHabilitado(): ?bool
    {
        return $this->controleFechaduraSensorPortaPrincipalHabilitado;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getControleFechaduraSensorPortaSecundariaHabilitado(): ?bool
    {
        return $this->controleFechaduraSensorPortaSecundariaHabilitado;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getControleFechaduraTypeFechadura(): ?int
    {
        return $this->controleFechaduraTypeFechadura;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getControleFechaduraAvisoPortaAbertaTimeout(): ?int
    {
        return $this->controleFechaduraAvisoPortaAbertaTimeout;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra"})
     */
    public function getTimeoutServidor(): ?int
    {
        return $this->timeoutServidor;
    }

    /**
     * @return Equipment
     * @Groups({"read-equipment_turnstile_tecnibra-relations","read-equipment_turnstile_tecnibra-equipment"})
     */
    public function getEquipment(): Equipment
    {
        return $this->equipment;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $nameInterno
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setNameInterno(?string $nameInterno): EquipmentTurnstileTecnibra
    {
        $this->nameInterno = $nameInterno;
        return $this;
    }

    /**
     * @param int|null $typeComunicacao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTypeComunicacao(?int $typeComunicacao): EquipmentTurnstileTecnibra
    {
        $this->typeComunicacao = $typeComunicacao;
        return $this;
    }

    /**
     * @param int|null $typeEquipamento
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTypeEquipamento(?int $typeEquipamento): EquipmentTurnstileTecnibra
    {
        $this->typeEquipamento = $typeEquipamento;
        return $this;
    }

    /**
     * @param int|null $typeFechadura
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTypeFechadura(?int $typeFechadura): EquipmentTurnstileTecnibra
    {
        $this->typeFechadura = $typeFechadura;
        return $this;
    }

    /**
     * @param string|null $servidorIp
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setServidorIp(?string $servidorIp): EquipmentTurnstileTecnibra
    {
        $this->servidorIp = $servidorIp;
        return $this;
    }

    /**
     * @param int|null $servidorPorta
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setServidorPorta(?int $servidorPorta): EquipmentTurnstileTecnibra
    {
        $this->servidorPorta = $servidorPorta;
        return $this;
    }

    /**
     * @param string|null $terminalIp
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTerminalIp(?string $terminalIp): EquipmentTurnstileTecnibra
    {
        $this->terminalIp = $terminalIp;
        return $this;
    }

    /**
     * @param int|null $terminalPorta
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTerminalPorta(?int $terminalPorta): EquipmentTurnstileTecnibra
    {
        $this->terminalPorta = $terminalPorta;
        return $this;
    }

    /**
     * @param string|null $terminalPortaSerial
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTerminalPortaSerial(?string $terminalPortaSerial): EquipmentTurnstileTecnibra
    {
        $this->terminalPortaSerial = $terminalPortaSerial;
        return $this;
    }

    /**
     * @param string|null $terminalSenha
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTerminalSenha(?string $terminalSenha): EquipmentTurnstileTecnibra
    {
        $this->terminalSenha = $terminalSenha;
        return $this;
    }

    /**
     * @param int|null $terminalNumero
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTerminalNumero(?int $terminalNumero): EquipmentTurnstileTecnibra
    {
        $this->terminalNumero = $terminalNumero;
        return $this;
    }

    /**
     * @param string|null $mensagemViradaLinha1
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemViradaLinha1(?string $mensagemViradaLinha1): EquipmentTurnstileTecnibra
    {
        $this->mensagemViradaLinha1 = $mensagemViradaLinha1;
        return $this;
    }

    /**
     * @param string|null $mensagemViradaLinha2
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemViradaLinha2(?string $mensagemViradaLinha2): EquipmentTurnstileTecnibra
    {
        $this->mensagemViradaLinha2 = $mensagemViradaLinha2;
        return $this;
    }

    /**
     * @param string|null $mensagemEntradaLinha1
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemEntradaLinha1(?string $mensagemEntradaLinha1): EquipmentTurnstileTecnibra
    {
        $this->mensagemEntradaLinha1 = $mensagemEntradaLinha1;
        return $this;
    }

    /**
     * @param string|null $mensagemEntradaLinha2
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemEntradaLinha2(?string $mensagemEntradaLinha2): EquipmentTurnstileTecnibra
    {
        $this->mensagemEntradaLinha2 = $mensagemEntradaLinha2;
        return $this;
    }

    /**
     * @param string|null $mensagemSaidaLinha1
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemSaidaLinha1(?string $mensagemSaidaLinha1): EquipmentTurnstileTecnibra
    {
        $this->mensagemSaidaLinha1 = $mensagemSaidaLinha1;
        return $this;
    }

    /**
     * @param string|null $mensagemSaidaLinha2
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemSaidaLinha2(?string $mensagemSaidaLinha2): EquipmentTurnstileTecnibra
    {
        $this->mensagemSaidaLinha2 = $mensagemSaidaLinha2;
        return $this;
    }

    /**
     * @param string|null $mensagemNegadoLinha1
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemNegadoLinha1(?string $mensagemNegadoLinha1): EquipmentTurnstileTecnibra
    {
        $this->mensagemNegadoLinha1 = $mensagemNegadoLinha1;
        return $this;
    }

    /**
     * @param string|null $mensagemNegadoLinha2
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemNegadoLinha2(?string $mensagemNegadoLinha2): EquipmentTurnstileTecnibra
    {
        $this->mensagemNegadoLinha2 = $mensagemNegadoLinha2;
        return $this;
    }

    /**
     * @param string|null $mensagemBloqueadoLinha1
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemBloqueadoLinha1(?string $mensagemBloqueadoLinha1): EquipmentTurnstileTecnibra
    {
        $this->mensagemBloqueadoLinha1 = $mensagemBloqueadoLinha1;
        return $this;
    }

    /**
     * @param string|null $mensagemBloqueadoLinha2
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMensagemBloqueadoLinha2(?string $mensagemBloqueadoLinha2): EquipmentTurnstileTecnibra
    {
        $this->mensagemBloqueadoLinha2 = $mensagemBloqueadoLinha2;
        return $this;
    }

    /**
     * @param int|null $sentidoEntrada
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setSentidoEntrada(?int $sentidoEntrada): EquipmentTurnstileTecnibra
    {
        $this->sentidoEntrada = $sentidoEntrada;
        return $this;
    }

    /**
     * @param bool|null $leitorBioHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBioHabilitado(?bool $leitorBioHabilitado): EquipmentTurnstileTecnibra
    {
        $this->leitorBioHabilitado = $leitorBioHabilitado;
        return $this;
    }

    /**
     * @param int|null $leitorBioModoIdentificacao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBioModoIdentificacao(?int $leitorBioModoIdentificacao): EquipmentTurnstileTecnibra
    {
        $this->leitorBioModoIdentificacao = $leitorBioModoIdentificacao;
        return $this;
    }

    /**
     * @param int|null $leitorBioPosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBioPosicao(?int $leitorBioPosicao): EquipmentTurnstileTecnibra
    {
        $this->leitorBioPosicao = $leitorBioPosicao;
        return $this;
    }

    /**
     * @param bool|null $leitorBio2Habilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2Habilitado(?bool $leitorBio2Habilitado): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2Habilitado = $leitorBio2Habilitado;
        return $this;
    }

    /**
     * @param int|null $leitorBio2Posicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2Posicao(?int $leitorBio2Posicao): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2Posicao = $leitorBio2Posicao;
        return $this;
    }

    /**
     * @param int|null $leitorBio2PictogramaEsquerdo
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2PictogramaEsquerdo(?int $leitorBio2PictogramaEsquerdo): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2PictogramaEsquerdo = $leitorBio2PictogramaEsquerdo;
        return $this;
    }

    /**
     * @param int|null $leitorBio2PictogramaDireito
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2PictogramaDireito(?int $leitorBio2PictogramaDireito): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2PictogramaDireito = $leitorBio2PictogramaDireito;
        return $this;
    }

    /**
     * @param int|null $leitorBio2ModoOperacao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2ModoOperacao(?int $leitorBio2ModoOperacao): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2ModoOperacao = $leitorBio2ModoOperacao;
        return $this;
    }

    /**
     * @param bool|null $leitorBio2ConsultaListaCadastral
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2ConsultaListaCadastral(?bool $leitorBio2ConsultaListaCadastral): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2ConsultaListaCadastral = $leitorBio2ConsultaListaCadastral;
        return $this;
    }

    /**
     * @param bool|null $leitorBio2ConsultaTabelaHorarios
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2ConsultaTabelaHorarios(?bool $leitorBio2ConsultaTabelaHorarios): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2ConsultaTabelaHorarios = $leitorBio2ConsultaTabelaHorarios;
        return $this;
    }

    /**
     * @param bool|null $leitorBio2ConsultaSinaleiros
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setLeitorBio2ConsultaSinaleiros(?bool $leitorBio2ConsultaSinaleiros): EquipmentTurnstileTecnibra
    {
        $this->leitorBio2ConsultaSinaleiros = $leitorBio2ConsultaSinaleiros;
        return $this;
    }

    /**
     * @param bool|null $tecladoHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTecladoHabilitado(?bool $tecladoHabilitado): EquipmentTurnstileTecnibra
    {
        $this->tecladoHabilitado = $tecladoHabilitado;
        return $this;
    }

    /**
     * @param int|null $tecladoPosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTecladoPosicao(?int $tecladoPosicao): EquipmentTurnstileTecnibra
    {
        $this->tecladoPosicao = $tecladoPosicao;
        return $this;
    }

    /**
     * @param bool|null $barcodeHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcodeHabilitado(?bool $barcodeHabilitado): EquipmentTurnstileTecnibra
    {
        $this->barcodeHabilitado = $barcodeHabilitado;
        return $this;
    }

    /**
     * @param int|null $barcodePosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcodePosicao(?int $barcodePosicao): EquipmentTurnstileTecnibra
    {
        $this->barcodePosicao = $barcodePosicao;
        return $this;
    }

    /**
     * @param int|null $barcodeFormato
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcodeFormato(?int $barcodeFormato): EquipmentTurnstileTecnibra
    {
        $this->barcodeFormato = $barcodeFormato;
        return $this;
    }

    /**
     * @param int|null $barcodeNumeroDigitos
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcodeNumeroDigitos(?int $barcodeNumeroDigitos): EquipmentTurnstileTecnibra
    {
        $this->barcodeNumeroDigitos = $barcodeNumeroDigitos;
        return $this;
    }

    /**
     * @param bool|null $barcode2Habilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcode2Habilitado(?bool $barcode2Habilitado): EquipmentTurnstileTecnibra
    {
        $this->barcode2Habilitado = $barcode2Habilitado;
        return $this;
    }

    /**
     * @param int|null $barcode2Posicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBarcode2Posicao(?int $barcode2Posicao): EquipmentTurnstileTecnibra
    {
        $this->barcode2Posicao = $barcode2Posicao;
        return $this;
    }

    /**
     * @param bool|null $rfidHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRfidHabilitado(?bool $rfidHabilitado): EquipmentTurnstileTecnibra
    {
        $this->rfidHabilitado = $rfidHabilitado;
        return $this;
    }

    /**
     * @param int|null $rfidPosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRfidPosicao(?int $rfidPosicao): EquipmentTurnstileTecnibra
    {
        $this->rfidPosicao = $rfidPosicao;
        return $this;
    }

    /**
     * @param bool|null $rfid2Habilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRfid2Habilitado(?bool $rfid2Habilitado): EquipmentTurnstileTecnibra
    {
        $this->rfid2Habilitado = $rfid2Habilitado;
        return $this;
    }

    /**
     * @param int|null $rfid2Posicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRfid2Posicao(?int $rfid2Posicao): EquipmentTurnstileTecnibra
    {
        $this->rfid2Posicao = $rfid2Posicao;
        return $this;
    }

    /**
     * @param bool|null $cofreColetorHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setCofreColetorHabilitado(?bool $cofreColetorHabilitado): EquipmentTurnstileTecnibra
    {
        $this->cofreColetorHabilitado = $cofreColetorHabilitado;
        return $this;
    }

    /**
     * @param bool|null $cofreColetorSensorColetaHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setCofreColetorSensorColetaHabilitado(?bool $cofreColetorSensorColetaHabilitado): EquipmentTurnstileTecnibra
    {
        $this->cofreColetorSensorColetaHabilitado = $cofreColetorSensorColetaHabilitado;
        return $this;
    }

    /**
     * @param bool|null $cofreBurroHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setCofreBurroHabilitado(?bool $cofreBurroHabilitado): EquipmentTurnstileTecnibra
    {
        $this->cofreBurroHabilitado = $cofreBurroHabilitado;
        return $this;
    }

    /**
     * @param bool|null $cofreTotem
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setCofreTotem(?bool $cofreTotem): EquipmentTurnstileTecnibra
    {
        $this->cofreTotem = $cofreTotem;
        return $this;
    }

    /**
     * @param int|null $bracoGiroLiberado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBracoGiroLiberado(?int $bracoGiroLiberado): EquipmentTurnstileTecnibra
    {
        $this->bracoGiroLiberado = $bracoGiroLiberado;
        return $this;
    }

    /**
     * @param int|null $bracoGiroLiberadoPosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBracoGiroLiberadoPosicao(?int $bracoGiroLiberadoPosicao): EquipmentTurnstileTecnibra
    {
        $this->bracoGiroLiberadoPosicao = $bracoGiroLiberadoPosicao;
        return $this;
    }

    /**
     * @param int|null $bracoOfflineStatus
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBracoOfflineStatus(?int $bracoOfflineStatus): EquipmentTurnstileTecnibra
    {
        $this->bracoOfflineStatus = $bracoOfflineStatus;
        return $this;
    }

    /**
     * @param int|null $bracoGiroTimeout
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setBracoGiroTimeout(?int $bracoGiroTimeout): EquipmentTurnstileTecnibra
    {
        $this->bracoGiroTimeout = $bracoGiroTimeout;
        return $this;
    }

    /**
     * @param int|null $memoriaCheiaStatus
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setMemoriaCheiaStatus(?int $memoriaCheiaStatus): EquipmentTurnstileTecnibra
    {
        $this->memoriaCheiaStatus = $memoriaCheiaStatus;
        return $this;
    }

    /**
     * @param int|null $revistaGrau
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRevistaGrau(?int $revistaGrau): EquipmentTurnstileTecnibra
    {
        $this->revistaGrau = $revistaGrau;
        return $this;
    }

    /**
     * @param int|null $revistaType
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRevistaType(?int $revistaType): EquipmentTurnstileTecnibra
    {
        $this->revistaType = $revistaType;
        return $this;
    }

    /**
     * @param int|null $revistaTimeout
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setRevistaTimeout(?int $revistaTimeout): EquipmentTurnstileTecnibra
    {
        $this->revistaTimeout = $revistaTimeout;
        return $this;
    }

    /**
     * @param bool|null $contadorDiplayHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setContadorDiplayHabilitado(?bool $contadorDiplayHabilitado): EquipmentTurnstileTecnibra
    {
        $this->contadorDiplayHabilitado = $contadorDiplayHabilitado;
        return $this;
    }

    /**
     * @param int|null $contadorDisplayPosicao
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setContadorDisplayPosicao(?int $contadorDisplayPosicao): EquipmentTurnstileTecnibra
    {
        $this->contadorDisplayPosicao = $contadorDisplayPosicao;
        return $this;
    }

    /**
     * @param bool|null $controleFechaduraSensorPortaPrincipalHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setControleFechaduraSensorPortaPrincipalHabilitado(?bool $controleFechaduraSensorPortaPrincipalHabilitado): EquipmentTurnstileTecnibra
    {
        $this->controleFechaduraSensorPortaPrincipalHabilitado = $controleFechaduraSensorPortaPrincipalHabilitado;
        return $this;
    }

    /**
     * @param bool|null $controleFechaduraSensorPortaSecundariaHabilitado
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setControleFechaduraSensorPortaSecundariaHabilitado(?bool $controleFechaduraSensorPortaSecundariaHabilitado): EquipmentTurnstileTecnibra
    {
        $this->controleFechaduraSensorPortaSecundariaHabilitado = $controleFechaduraSensorPortaSecundariaHabilitado;
        return $this;
    }

    /**
     * @param int|null $controleFechaduraTypeFechadura
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setControleFechaduraTypeFechadura(?int $controleFechaduraTypeFechadura): EquipmentTurnstileTecnibra
    {
        $this->controleFechaduraTypeFechadura = $controleFechaduraTypeFechadura;
        return $this;
    }

    /**
     * @param int|null $controleFechaduraAvisoPortaAbertaTimeout
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setControleFechaduraAvisoPortaAbertaTimeout(?int $controleFechaduraAvisoPortaAbertaTimeout): EquipmentTurnstileTecnibra
    {
        $this->controleFechaduraAvisoPortaAbertaTimeout = $controleFechaduraAvisoPortaAbertaTimeout;
        return $this;
    }

    /**
     * @param int|null $timeoutServidor
     * @return EquipmentTurnstileTecnibra
     * @Groups({"write-equipment_turnstile_tecnibra"})
     */
    public function setTimeoutServidor(?int $timeoutServidor): EquipmentTurnstileTecnibra
    {
        $this->timeoutServidor = $timeoutServidor;
        return $this;
    }

    /**
     * @param Equipment $equipment
     * @return EquipmentTurnstileTecnibra
     */
    public function setEquipment(Equipment $equipment): EquipmentTurnstileTecnibra
    {
        $this->equipment = $equipment;
        return $this;
    }
    //endregion
}
