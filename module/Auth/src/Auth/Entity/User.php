<?php
namespace Auth\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

// setters and getters - Zend\Stdlib\Hydrator\ClassMethods, for public properties - Zend\Stdlib\Hydrator\ObjectProperty, array
// Zend\Stdlib\Hydrator\ArraySerializable
// Follows the definition of ArrayObject.
// Objects must implement either the exchangeArray() or populate() methods to support hydration,
// and the getArrayCopy() method to support extraction.
// https://bitbucket.org/todor_velichkov/homeworkuniversity/src/935b37b87e3f211a72ee571142571089dffbf82d/module/University/src/University/Form/StudentForm.php?at=master

// read here http://framework.zend.com/manual/2.1/en/modules/zend.form.quick-start.html

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Auth\Entity\Repository\UserRepository")
 * @Annotation\Name("user")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Username:"})
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=100, nullable=false)
     * @Annotation\Attributes({"type":"password"})
     * @Annotation\Options({"label":"Password:"})
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=60, nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Options({"label":"Your email address:"})
     */
    private $userEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_role_id", type="integer", nullable=true)
	 * @ORM\OneToMany(targetEntity="user_roles")
	 * @ORM\JoinColumn(name="userl_id", referencedColumnName="userl_id")
	 * @Annotation\Type("Zend\Form\Element\Select")
	 * @Annotation\Options({
	 * "label":"User Role:",
	 * "value_options":{ "0":"Select Role", "1":"Public", "2": "Member"}})
     */
    private $userRoleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lng_id", type="integer", nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Language Id:"})
     */
    private $lngId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_active", type="boolean", nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Radio")
	 * @Annotation\Options({
	 * "label":"User Active:",
	 * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $userActive;

    /**
     * @var string
     *
     * @ORM\Column(name="user_picture", type="string", length=255, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"User Picture:"})
     */
    private $userPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password_salt", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Password Salt:"})
     */
    private $userPasswordSalt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_registration_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime","min":"2010-01-01T00:00:00Z","max":"2020-01-01T00:00:00Z","step":"1"})
     * @Annotation\Options({"label":"Registration Date:", "format":"Y-m-d\TH:iP"})
     */
    private $userRegistrationDate; // = '2013-07-30 00:00:00'; // new \DateTime() - coses synatx error

    /**
     * @var string
     *
     * @ORM\Column(name="user_registration_token", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Registration Token:"})
     */
    private $userRegistrationToken;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_email_confirmed", type="boolean", nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Radio")
	 * @Annotation\Options({
	 * "label":"User confirmed email:",
	 * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $userEmailConfirmed;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $userId;

	public function __construct()
	{
		$this->userRegistrationDate = new \DateTime();
	}

    /**
     * Set userName
     *
     * @param string $userName
     * @return Users
     */
    public function setuserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getuserName()
    {
        return $this->userName;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return Users
     */
    public function setuserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getuserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Users
     */
    public function setuserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getuserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userRoleId
     *
     * @param integer $userRoleId
     * @return Users
     */
    public function setuserRoleId($userRoleId)
    {
        $this->userRoleId = $userRoleId;

        return $this;
    }

    /**
     * Get userRoleId
     *
     * @return integer
     */
    public function getuserRoleId()
    {
        return $this->userRoleId;
    }

    /**
     * Set lngId
     *
     * @param integer $lngId
     * @return Users
     */
    public function setLngId($lngId)
    {
        $this->lngId = $lngId;

        return $this;
    }

    /**
     * Get lngId
     *
     * @return integer
     */
    public function getLngId()
    {
        return $this->lngId;
    }

    /**
     * Set userActive
     *
     * @param boolean $userActive
     * @return Users
     */
    public function setuserActive($userActive)
    {
        $this->userActive = $userActive;

        return $this;
    }

    /**
     * Get userActive
     *
     * @return boolean
     */
    public function getuserActive()
    {
        return $this->userActive;
    }

    /**
     * Set userPicture
     *
     * @param string $userPicture
     * @return Users
     */
    public function setuserPicture($userPicture)
    {
        $this->userPicture = $userPicture;

        return $this;
    }

    /**
     * Get userPicture
     *
     * @return string
     */
    public function getuserPicture()
    {
        return $this->userPicture;
    }

    /**
     * Set userPasswordSalt
     *
     * @param string $userPasswordSalt
     * @return Users
     */
    public function setuserPasswordSalt($userPasswordSalt)
    {
        $this->userPasswordSalt = $userPasswordSalt;

        return $this;
    }

    /**
     * Get userPasswordSalt
     *
     * @return string
     */
    public function getuserPasswordSalt()
    {
        return $this->userPasswordSalt;
    }

    /**
     * Set userRegistrationDate
     *
     * @param string $userRegistrationDate
     * @return Users
     */
    public function setuserRegistrationDate($userRegistrationDate)
    {
        $this->userRegistrationDate = $userRegistrationDate;

        return $this;
    }

    /**
     * Get userRegistrationDate
     *
     * @return string
     */
    public function getuserRegistrationDate()
    {
        return $this->userRegistrationDate;
    }

    /**
     * Set userRegistrationToken
     *
     * @param string $userRegistrationToken
     * @return Users
     */
    public function setuserRegistrationToken($userRegistrationToken)
    {
        $this->userRegistrationToken = $userRegistrationToken;

        return $this;
    }

    /**
     * Get userRegistrationToken
     *
     * @return string
     */
    public function getuserRegistrationToken()
    {
        return $this->userRegistrationToken;
    }

    /**
     * Set userEmailConfirmed
     *
     * @param string $userEmailConfirmed
     * @return Users
     */
    public function setuserEmailConfirmed($userEmailConfirmed)
    {
        $this->userEmailConfirmed = $userEmailConfirmed;

        return $this;
    }

    /**
     * Get userEmailConfirmed
     *
     * @return string
     */
    public function getuserEmailConfirmed()
    {
        return $this->userEmailConfirmed;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getuserId()
    {
        return $this->userId;
    }
}