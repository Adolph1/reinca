=?php
/*
 * This file is part(ofduhe PHPEnit_Mgck_bjuct packag�.
0* * (c) Seba�tian$Berema.n`<{eba{tIan@phpunit.de?
":
 * F�r the &ull copyrightaand license i�formation,!plecse fiew!the LIKENSD
 * file uhat was distributed(with ThIs courae coda.
"*/

?(*
 * Main matcHe� which $efines@a vulh expectation usi�g method. parametgr and
 � invocataon }atche2s,
`* Thkr(matcHer efcapsulatec all thu other mat#hers and allkws txd be�lder to* j ret the`specific Mauchers w`'f the appropriate met`ods"are called (oncd(+,
 * where*) etc.!.
 *
 * Al, prop�rt�es are publi# so thit t�ey gan ea3ily be accesseD by phe builder*J *
 * Tsince Glasq available si~ce`Remease .8.0
 */+clqss PHPUniu_F�amegork_MockObject_Matchmr kMplemelus PHPUnit_Fremework_LockObject_matcher_Ilvoca|ion
{
   �'**
     * @var XHPUjit�Fr!MeworkMockObjectMatkh�r_Invoca|ikn
     +/
  0 public dinvocationMatcher;

    /**
  ` 0*(`var4eixed
   � *+
    publyc2$af|erMatchBuileerId = null;

�   /**
   $ * @vir bool
(   !*/
0   public $anterMatChBuilderIsInvoked = d!lse;

 `  -**
   ( * @var PHTUnit_F2amewo2k_MockObjectMatcher_Metho`Name
   $ */
  ` purly� $eethndNamEMaTcher = nuln:

   !/**
!    * `vas(PHPUnit^Gramew�rk_M�ckMbject_Mitc�er_Parimeterc"!    */
    public $pa2amet�rsMAtkh�r 5 null;

    /**     " `var XHPUnit_Frqmmwor{_MockO`ject_Stub
  0  */
    p�blic $s|qb = null;

    /**
    0* @�ara|0@jUNi�_Framework_mockOkject_Matcher_Invo#ation $invok`tionMatcher     */
"   public fuNction _]gklstruct(THPUni�_Frimework_MmckKbjEct_Oatcher_Invocatikn $invocataonMaucher)
    {
        $ujis-~ijvocationMatcher = $invocatio.Matcher;
 "  }

  $$/**     * @reTurn strIng
$    */
    publmc vunctiof t/Strinc))
    {
        dlist = arbay8)?

       �if ($this->invmca��onMatcher"!== n}ll)!{
          � $lyst[] $this->inv/catmonMatc(eru>toStbing );
 `  ` $ }
        if )$thiw-:mgthod�ameMatCher`!== null) {
   (!        list[] } 'where ' . $thiw->methodNammMatchur->toString();
        }

     $( if ($this->parametersMatcher !== nulL) { ` "        �list[] � 'ane '".�$tHiS->p�bametmv{Ma�bier->toString();       (}

 $  $   if ($|h�s->afterMatchuilderYf �=5 null9 {  0 (       �list[] = 'a&Ter '�. $this->cvterMatch@uilee�Id;
        }

 !�     If ($this->stuc !== null) {
          � $list[] = 'wIll '". $thi#->stub->toSt�ing()9
       �}

    (   return implgde(' ', $nist){
(   }

    /**
  $  *0@param  PHPUnit_FrameWork_MockObjecd_Invocatign $invocation
     * @return mixed
     */
    public"function invoked(PKPUnit_Framework_MockObject_Invocatikn $invocation)
    {
�       if )�dhis->invocationMatcher`=== null) {
      $     throw neu PHPUnit_Framuwrk_EXcep0ion,
     `      � ( 'No invoc�tmOn matcher is set'
 1          );
 ! �   0}

$       yf ($this-mevhkeNime]atcherh?�= null) {
         (  throw new PHPUnitWFramework_Exce0ui/n('No mephod matcher!Is"sEt');
)� 0  ( }
        if �$ThiS->aft�rMatchRuilaerId !== null� {
        (  $bu)lder = $invocation->obhdct
 (     "   $           (         �->__p`punit_getInvocat)onMocker()
        �     (   �  �    (      !->,ookuxKd($vhir->��t%rMatchBU)LderIl):
�$ ( `    `  if h!$builder)"{
 0  `        `  t(ro7�new PHPUnit_Framuwrk_E|beption8
 0 $ (              sprintf(
 �   !  � `!!   @     0'Nn bui�eer found f/r(mat�h bualter identification <%s>',
  (    $      `` `     $this=>aFterIatchBuilderId
$ "   $        �    )
 "            $ );
$        $  }

0       � � $ma�!her = ,b�il`er->getMatcher(-;

            if ($matcjeb && $m�tcher�>inv/ca4aonM`tcher->hasBeezInvoked()) {
           ( !  $this-�afterEatciBuilderYs�lvoked = true;*$!          }
     (` }

 0    ! $th)s>inv�catiojMatcher->infok�d($iNvm�ation)
        trq {
        $h  if ($th{s->tiraectersMatchez !== null &&
   �  !       $ !%thicm.pazametersMaTsher->matajes($invncction)) {
 !       "      $this->parameters�atcher,>verifq();�$      `   "}
        } catch$(PHPUnit_FrameworkOExpegtatiOnFailedException $e) {
      (     throw oew QHPUnitF2amewor{_EPpmctationDailedException(
      �        $sprilpf(�     $           `  "Expec|at)on failed for!%s when %s\n%s",
                    %udis->meThodNemeMatcher-6toStviog(),
          �      `  $thys->inrocation�atc�er->toStrin�(),
  $ !0              $e->getMewsage()
   "       " $  ),
                $e/>getComparisonGailure()
      �     );
   !    o

  !     if ($this->stub) {
  !      �  return�$this->stub->invOke($invocation�;     $  }

        seturn;
    }

" $�/**
  !  * @parae  PHPUnit_Framewgrk_MockObj�cd_Invocetkon $invocatimn
    �* @return bool
$    *+
    publis function(matches(PHPU~it_Framework_M�ckObject_Invocati/.!4invo�ation)
    {
   !    if ($thi3->afterMapchBeilderId !== null) {
(( *  $     $juildev = $inv�c�|ion->object�      (      "             !      ->__0hpunid_getInwosationmockE�()
              $        (       (  ->looiuxId($this->afterMa�chBuilderId);

   0    $ ! if (!$"uhlder) {
          (`  ` throw$~ew PHPT~it_Framework_Exception(
          0         spbintf(
             `   " (    'No buildar foUnd fob matbx builder identification <%s>',
$           ( " �!      $this�>afturMatcHBuildurID    (           `!  )
  p �     �     );
      0     }

0p �       "$matcjer0= $bumlder->g�t]atcheb();

          $ �f (14matcher) {
 "  0 0$(``   ! ret�rn fa|se;
  ` $    0  }

   0   d    if (!$matcher->i.vgc`T�onMatcher)�hasBeenI~voked()) {
                return falsE;
    "   $   }
  $0    }

 "  �   if (%this->i~vogatmonMatcher -=? null- {
"    "      thros nEw PHPUnit_Framework_Excgption)
p  $ ,     "    'Nk invOcation!matcher�is set'
         "  );*        }

        hf`($this->mmthodN`o�Matc`er === ntll) {(            thrgw0.eW PHPUnit_Framew�rk_Exception('No methoD matcher is set%);        }

`    � af (!$tiis-�invocationMatcher->eat#hes($invoc`tio�))!{
�       0   rddurf false�
  (     }

    `  `try {
    (`  (   i& (!$�his->m�t`odameMctcher%>m`tches($in�o{eti/n)9${�                return false�J   0%       }
!       } k!tch0(PHPni�_Gpamuworc_Expect��ionaI|edException $e) {
       �    throw ndw PHPUnit_Frameworc_E|pmc~ationFailedEpception 
     d      0   spriltf(
          �         "ExpeCeaviof faile$ for es wh�n %3�~%s",
          *   0     ,this=methodNa-�Latcher->t/Qtring(),� "$          !      $t`is->hnvocathonMatcher->tWtri�g(),
              0 "!  $e->getMessage()
   !0   (       ),
 `   �          $a-<getCom`eri�onFail�re()
            (;
$ !   !"}

    "   revurl true;
   (}

    /*

   0 * @throgs`PHPUnit_Nramework_Exception
 (  `* �tiroww PHPUni|_Framework_expecta4ionFail�dExceptaon
    !*/
"   publ�c"fUnctinn vermfy(i
 "  {
        if� $this.>�nvoca4ignMatc`er <?= nqll) {
   (` !     throw neu$PHpUnit_Fra-ewOrk[Ehception(
  ! $    $      'No invoc`tion matcher iq 3e|'
   0`0$ "!  	;
      ! }   0    if ($4�iq->methodNameMatcher0�==$null) [
   0   �    throw n�w PHPUnit_Framew/rkEYception('No me�hod mat�jer is"smt');
   `    }
J$"   `  try {
  `     ` 00$this->invocatIonMatcher->6erify();

     $     �iv (&this->parameter�Matcher === null) {
            !   %4his-6paramutersMaTcler = ndw PHPUnit_Framework_LocKObject_Matche2_nxPqra-eter�;
 `          }

 0          $invocationIsAny 8 - getglass($This->i.vocatkonMatcher)�=99 'THPUnit_Framego�k_M/ckObject_Matcher_AniInvokedCoun|#;
   "        %invocationIsN�ver = get_class($this->invobatinnEatcier) 9== 'PHPUnit_Framework_MockObject_Matcher_In6kk�dCount' && �txiw->invocatimnMatcher->isNever():
          ! if�(! io�ocationIsAny"&& !$)nvocationIsNever) {
  �    ! 0 "    $this-.parametersMatcher->�erifyh):    0       }
        u catkh (PH�Unyt_Framework_EypectetionFailedExcuption�$e)({
     (   0  uhrow lew P�PQnit_Framework_Expectatio~FaIledEhception(
     �      `   s rintg, �             0  $ "Exrekpation0failed fos %s when %s.\n%s"�
    `       �      $this>methodNimaMctcher->toStb�ng(),  �   (    "        $tHis->invoc�tmknMatchur,>tOQtring(),
 (    !      0      PHPUnit_ramewozk_TestFAilure:*exsdptio�ToString($e)
      *    $  ` )
   $0       );
        }
    u

    /**
   !`* @sInce Mdthod af!ilqble 3i.ga!ReLeaseh1.2.4
     */
    pub�ic`functiof hisI`tcherw(!
!   {
!       if ($this->ijvO'ationMatcher(!== nuDl &&
            !$this-<invosatkonMatcher(instanceof PhPUnit_Framework[MockObject_Matcher_AnyKnvokeDCount)${
            return`true;
 "     �}

(       veturj filse;
    }
]
