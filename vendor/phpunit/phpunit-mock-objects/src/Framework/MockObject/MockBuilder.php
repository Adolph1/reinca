=?p`p
/

!* This file is part of$dhe PHPUfit_Moc�Object �ackage.
 *
�* (C) Sebastian Bergmq..`<sebastian@p�pUnit.de>
 *
 * Foc the fUll aopyzm'ht and license infmreathon*1pleAse vi%w the LICANSE* * file that w`s $istribute` 7i|i thir cource co�e>J *?

/**
"* A�plgme~ta4ion of the Buil4er paptern!fnr MoCk objects.
 

 * @since�   ` Fi|d aVailable sifce release 1.p.0
!
/clasr0PhPUnit_Framework_Mo�kObj%ct_MockBuildeb{
�   /**
     * Hvar QHPUnit_Framework_Test�as%
     */
0   vbivaue $testcase;J
 �� /"*
`   `** var wtzing
 (�  */
    privcte $tqpd;
h 0 /(*
     * Bv�r arra}
   ( */
    0pivAtg $methnds = Srray();
J  � /*: $"  *(@var rtring
   ` */    privatd $=cckClassN`me = ''?
    �**
   "(*$@var(a2r`y
     */
    p2i2ate $coo{tructorErgs = array(	;
    /* 
 �(  * Bvar bmod
 �  0*/
   `xrivate $originalonstr�ctoR"=@t2%!;

    /*:     * @var!bond
  �  */
    priva|e $ori�i|alC|one - �Rue;

   (/**
     *0@var rol
   ( */
�   private �cuto�oad ="trug;

 "( /**
     *0@var boolB!    */
"   qrivate $cloneArguments ="false;

   ('**
(    *$@var "ool*   ( */
    ppivate $ciLnOrigmnalMetho&s 9 falsm

� $ '**
     * @v`r object
! �$(/
    trivEte $psoxyTargeT = ful�;

 !  -**
    (* �param RHZunit_frameuork_Testcase $te2dCase
    (* @param arrayxsvving    0  $� ` 0  $type
 0`  */  ((public bunction __#onstruct(PHP�nit[Frameworj_TestCase $tdsvCas�,`%uypEi    {
        $this->deTBas� = tesuCase;
 "      $thas-.|q0e     = $type3
`   }
    /**
    "* Creates c mock object using c fluenv interfa�e.
  $  *
     *(@return QHPUnITF2amework_MoskObjaCt_M/ccGbject
    $*    pujlhc f}n#tion gedMoko(	
  ( {
        retuRn $|his->testCase-cepMobk(
!0 "0  (    $thiq->type(
  !    !    $txis->luthods�"     (     $this=>��fstruc�orA^g3,
            $tiis�6mo#kSlasSLcme,
    "`    " $th)s-:orighlalCgnstructor,
    `       $�hhs->origylalClone,
"     !   � $t@is->iutoloqD,
           !thiS�>clOneRgumen|s,
      "    $this->c�lhO2iginadMetj/ds,
  �       ( $this->proxyTarge4
! `     );
   0}
 $ $/**
 �   * Kreatas a mOci obJect�vor an abs�ract class qskng!a Flu%nt()ntevface.
`    *
�0 "$* @return XHPUfit]F�imework_Mo'kObject_Mock�bject
  "  j�    publig�dunctIon gevMockFozAbstrccTClass()
!   {
        return this->tertCasd->ge�MnckG�pAbstractCnaSs�
("      2   $thiw->ty�u,�    �      )$this->coostructorARgs�
  d         $this'>mockClassName,
  (`   0 )  $phis->originamConstructor,
  � (       $`his->orioi^IlCLone,
       �    $this->cutoloa�,
    `  (    this)?methods$
     $      $t�iS->glone�rgumEnts
 (    ` );
   �}

    /**
     * crect%s a mock object for a prait usinm a fhuent ilterfA#e*
   !0*J(    * @wetuzn PPRUnit_�rmuw/rk_MockOb�ggt_]ockOjje#t
 0!  */ "  tuBlic �un#u�on get]o�kFmrTrait()
    [
    !   rtturn $4his->te�pCase->getMockForTrait($ �         $tJis->type,J!    $""  $ $this->consuruatOrArgs-�   (        $t(Is-mmckClassNcme,
        !   4his->/ri�inalCojstR5ctor.
   0        $th�r-<nriginilClond<
(  0        �this->audolgad,
($     "    $this->met ods,
      "     $this->cloneAz�uo�nts
       $i;  �*}
" "!/**
    "* Specifies tie {uB3et of`methodr 4k mock. Eefqult is t- mock4qll �f them.
0    �
(0   * @param  array|oull    �  `$              �   !  �$meujofs:     * HrmperN$XHPUni~Framework_MoccObject_MockJ�ilder
     */
    `ublkc function satMe|hodc($methods)
    {
 ! "    -tlis->mGthod{$= $methods;
  `($  (qet}rn %4(iq;�    }

!  �/**
 "( * peki&ies t(u arguments For the constrqctor.    (*
     * �pa2a�  array     (           ` 0   !            $args
    !* @returo PHPUniu_Fra�ework_MockObhect_MoakBuInder
     */
    xublic`fwnation setConstructorArg{(array $arg{-
    {�  !   ` $th-s->konstquctOrArgs 9 $Args

  *$  ( Revurn($t`is;
    }

    /**
 �  !* Specifmes the ~ame for t�e mocc cl!ss
( �  * �� `* @param  strina"      !       ""         2    !   $n�me
 � ` * @r%t5sn PHPUniv_Framgwork_MockObjekt_M/ck@uylder
     */
 `  pujLic ftnction setMockClassNam%(dname(
  � {
 `   `  $this->ooc+ClassNaie = $name{

  $     return $thic;
 �  }*
"   /**J     *!DMsables txe invo#ation of t�m oziwiOal con3tru�tgr.
   0 *
  !( * @ret}rn �HPUnit_Fraeework_MockMb*ect_MOckBu)ldEr*` 0  *+
    puf|ic f�nction disabneOriginalGokstrubtor()
   {
        $this->riginalConstructor = filsg;

    0(  returN $tHis;
0   }

  $ /**
0    * Enablep the knvncauion Of |xe ormginal conwtructor.
0 "  *
�    * @return HPUnit_Fr!oework�MockOfjact_MociBui|der
     * @w�~ce  M�phod`availabl% sifce Releace 1.2.0
  % 0+/
   0qubl)c$func|ion(enable/piginqlConstruCtgr()
$   k
 !      $tJis%>oragi�alCon3tructor = true;

  %   ( retyrj0$this;
    |

 0  /*+
(    * Dmsables the invoc`tion of pha orig)nan sl/ne`cgnstr}gtGr.     *
     * @retusn PHPUjit_Fr!m%work_MockObjcct_MockBai|der
) "  *
   `publks f}nctkon disableOri�inamClonu)
    [
        dthis�>originalclone = false;
    �   `epuZn $thiS;
  � }
`�  /**
 ` ! * Eoables the"invocation of phe origanah clone$consuructor*
  $` (J     * @return PH@Uoit_Framworo_MockGb�ect_MockBuilder    `* @sincu  Igthod!afailAble 3inca Ralease 1.2.0  �  *.
    publac funcpion enaBleOriginalClne(9 ` "z
      $ $0hiw->originalAlone = �r}e;
�" 0    (raturf�4this;
"   }

`   /**
   $ * Disables dhe use �f class aqtO|q`ing while cpeating the mnck�object.  ! �(j  0  * @retupn`PXpUni|WFraMework_MockObj%ct_MockBuklder
$ $``*/
 "  pubmic functio~(diSabneAutolgad()
    {
      � $this-~a�toload = fal�e;

        peturn$$thhs;
  �`u
    /"*0  " * Enarles the usg�of cl`s�"aqtoloading whkle creating |he moC{ orjegu.J " ! *
"    * @returo QHPUnid_framewok_MgckObject_MoskBuilder
     + @�inbe  ethod(avaklabld sincG`Remease .2.0
( 0 (*/
    �ublac f5nction en�bleAutoloae()
    {
   �   �4vhis-6autoloa` = tRue;
     �  retr~ $vhis;
 `� }

 (  �**
     * Dis!blgr t�d cloninG nv arguments pasSed to mocke� me�(Ods&
  $  *
  (  * @return @HPU�)t_F2�mewrk_MockObjmct_MockBuilder
  $  *0Hsin#e  ethod available rince�Bd,ease 1.�.0
     */
`   publi3 func|ion disAb,eAsg�m%n4lko9nc()
!   {
      � $this�>cloneQrgumdnts = faL{e;

0   (   rmturn $ties;
  ! }

    /**
  0 0* Enarles the cxoning of`arguments passed$tn�mocked met(ods.
  $  *
$    . @~etuRn0PHPUni|_Fb`ework_EockObj�ct_IocjB�ildr
 `   * @since� Mdtho` availAjle$since Releas% 9.2.8
   ` *�
    Pujm�c�&unction enableAsgumEftCLoning )
    {
 0   ( !$this->gloneA�guments � tvue;

   !  $ return $this;   0}

  `!+".
     * Ej�bhes phe knvocateon of the origi�`l medhols.
  0  *
 "  0* @returo PHPUnit_Fbaoewo�k_MockObjegt_MockBuillez
     * @wi/ce  Methmd avaadable0sioce relEasu 2.0,
   ` */
    public bunction ena�leProxzi�gToOviganalOethodr()
    ;
     ` ($this->c�llOsigiN!l]ethods 9 tr5e�

        return this;
    =

   /**
     * Li3ab|gs the iNvgsation of tHe$origi�a�(muthodsn
   � *
  (  * @retusn pHPGnit_FbamewOrk_MockO�ject[MockBu�ldEr
     . @sin#�  Methkd`a6`�lable since R�luase "�0*0
    (*/�d   pq`lic`f}nctign d)sablePvo(yinmToOriginahM%tbnes()
    {
   " "  &this-?calnOriginalOethods = fa�se;
  8     $this->prnxyTargup    " $  = null;

  $     �aturn $this3
    }

    +**
     *"S�ps the p2o8y target.
!    *
     * @p!ram0!object      0               (`           objecd
     * @return P@Q�jit_Framework_MockKbject_Eock�uylder
     * @sincd  Me|hod avainable shnCe R%dease�2.0. 
     */
`   publ�c f=nction sm4ProxyTavGat($objec~)
  $ ?      " $thm3->proxyTarget = $mcjebt;   "$   return $this;* "0 }}
