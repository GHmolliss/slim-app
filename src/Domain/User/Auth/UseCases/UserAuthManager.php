<?php

declare(strict_types=1);

namespace App\Domain\User\Auth\UseCases;

use App\Domain\Mail\Task\MailTaskFacade;
use App\Domain\Pages\Getter\CourseProgressCollection;
use App\Domain\Telegram\TelegramFacade;
use App\Domain\Telegram\ValueObjects\Message;
use App\Domain\User\Auth\Exceptions\UserAuthManagerException;
use App\Domain\User\Group\UserGroupFacade;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\NumberPositive;
use App\Domain\ValueObjects\Token;
use App\Domain\ValueObjects\UserLastName;
use App\Domain\ValueObjects\UserPassword;
use App\Entity\User;
use App\Entity\UserContact;
use App\Entity\UserProgress;
use App\Helpers\CookieHelper;
use App\Helpers\HashHelper;
use App\Helpers\JwtHelper;
use App\Helpers\StrHelper;
use App\Repository\Doctrine\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class UserAuthManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
    ) {}

    public static function getExpiration(): int
    {
        return time() + (3600 * 24 * 7);
    }

    public static function setCookieToken(string $token, int $expiration): void
    {
        CookieHelper::set(CookieHelper::TOKEN_KEY, $token, $expiration);
    }

    public static function deleteCookieToken(): void
    {
        $expiration = time() - 3600;

        CookieHelper::set(CookieHelper::TOKEN_KEY, '', $expiration);
    }

    public static function deleteSession(): void
    {
        self::deleteCookieToken();

        session_destroy();
    }

    public function find(): ?User
    {
        return $this->userRepository->findAuth();
    }

    public function findByToken(
        Token $token,
    ): ?User {
        return $this->userRepository->findAuth($token);
    }

    public function register(
        UserLastName $lastName,
        Email $email,
        UserPassword $password,
    ): NumberPositive {
        // $group = $this->userGroupFacade->getUser();

        // $user = $this->userRepository->findOneBy(['email' => $email]);

        // if ($user) {
        //     if ($user->getActiveEmail() !== null) {
        //         throw UserAuthManagerException::emailNotActive($user->getActiveEmail());
        //     }

        //     throw UserAuthManagerException::emailDuplicate();
        // }

        // $user = User::create(
        //     $group,
        //     $lastName,
        //     $email,
        //     $password,
        // );

        // $userProgress = new UserProgress($user);

        // $this->entityManager->persist($user);
        // $this->entityManager->persist($userProgress);
        // $this->entityManager->flush();

        // $token = HashHelper::userTokenEncode((string) $user->getId());
        // $user->setToken($token);

        // $contact = new UserContact(
        //     $user,
        //     UserContact::TYPE_EMAIL_ID,
        //     $email,
        // );

        // $this->entityManager->persist($contact);
        // $this->entityManager->flush();

        // $this->mailTaskFacade->userRegister(
        //     new NumberPositive('userId', $user->getId()),
        // );

        // $this->telegramFacade->sendAdminUserAdminMessage(
        //     new Message('message', "[UserAdd]: id={$user->getId()} name={$user->getFirstName()} email={$user->getEmail()}"),
        // );

        $userId = new NumberPositive(1, 'userId');

        return $userId;
    }

    public function login(
        Email $email,
        UserPassword $password,
    ): string {
        $user = $this->userRepository->findOneBy(['email' => $email->get()]);

        if ($user === null) {
            throw UserAuthManagerException::loginError();
        }

        if (!password_verify($password->get(), $user->getPassword())) {
            throw UserAuthManagerException::loginError();
        }

        if ($user->getActiveEmail() !== null) {
            throw UserAuthManagerException::emailNotActive($user->getActiveEmail());
        }

        $payload = [
            'sub' => $user->getId(),
            'iat' => time(),
            'email' => $user->getEmail(),
        ];
        $token = JwtHelper::generateToken($payload);

        $user->setUpdated();

        $this->entityManager->flush();

        return $token;
    }

    // public function verifyEmail(
    //     Token $token,
    // ): void {
    //     $user = $this->userRepository->findAuthNotCheckActive($token);

    //     if (
    //         $user === null
    //         || $user->getActiveEmail() === null
    //     ) {
    //         throw UserAuthManagerException::authUserNotFound();
    //     }

    //     $user->setActiveEmail(null);

    //     $this->telegramFacade->sendAdminUserAdminMessage(
    //         new Message('message', "[UserVerifyEmail]: id={$user->getId()}"),
    //     );

    //     $this->entityManager->flush();
    // }

    // public function passwordForgot(
    //     string $email,
    // ): void {
    //     $email = StrHelper::prepareEmail($email);

    //     $user = $this->userRepository->findOneBy(['email' => $email]);

    //     if ($user === null) {
    //         throw UserAuthManagerException::passwordForgotEmailNotFound();
    //     }

    //     if ($user->getActivePassword() !== null) {
    //         throw UserAuthManagerException::passwordForgotNotActive($user->getActivePassword());
    //     }

    //     $this->mailTaskFacade->userPasswordReset(
    //         new NumberPositive('userId', $user->getId()),
    //     );

    //     $dateTime = new DateTime();

    //     $user->setUpdated(new DateTime());
    //     $user->setActivePassword($dateTime->modify('+24 hours'));

    //     $this->entityManager->flush();

    //     $this->telegramFacade->sendAdminUserAdminMessage(
    //         new Message('message', "[UserPasswordForgot]: id={$user->getId()}"),
    //     );
    // }

    // public function passwordReset(
    //     string $password,
    //     Token $token,
    // ): void {
    //     $password = StrHelper::preparePassword($password);

    //     $user = $this->userRepository->findAuth($token);

    //     if (
    //         $user === null
    //         || $user->getActivePassword() === null
    //     ) {
    //         throw UserAuthManagerException::authUserNotFound();
    //     }

    //     if (password_verify($password, $user->getPassword())) {
    //         throw UserAuthManagerException::passwordResetDuplicate();
    //     }

    //     $user->setUpdated(new DateTime());
    //     $user->setPassword($password);
    //     $user->setActivePassword(null);

    //     $this->entityManager->flush();

    //     $this->telegramFacade->sendAdminUserAdminMessage(
    //         new Message('message', "[UserPasswordReset]: id={$user->getId()}"),
    //     );
    // }

    // public function deleteExpiredActivationEmail(): void
    // {
    //     // TODO: Удаление через UserFacade
    //     while (!empty($users = $this->userRepository->getExpiredActivationEmail())) {
    //         foreach ($users as $user) {
    //             $userId = $user->getId();

    //             $this->symfonyStyle->writeln("<info>userId={$userId}</info>");

    //             $contacts = $user->getContacts();

    //             foreach ($contacts as $contact) {
    //                 $this->symfonyStyle->writeln(" - delete contact id={$contact->getId()}");

    //                 $this->entityManager->remove($contact);
    //             }

    //             $progress = $user->getProgress();

    //             $this->symfonyStyle->writeln(" - delete user progress id={$userId}");

    //             $this->entityManager->remove($progress);

    //             $this->symfonyStyle->writeln(" - delete user id={$userId}");

    //             $this->entityManager->remove($user);
    //             $this->entityManager->flush();

    //             $this->telegramFacade->sendAdminUserAdminMessage(
    //                 new Message('message', "[UserExpiredActivationEmail]: delete id={$userId}"),
    //             );
    //         }
    //     }
    // }

    // public function deleteExpiredActivationPassword(): void
    // {
    //     while (!empty($users = $this->userRepository->getExpiredActivationPassword())) {
    //         foreach ($users as $user) {
    //             $this->symfonyStyle->writeln("<info>userId={$user->getId()}</info>");

    //             $user->setUpdated(new DateTime());
    //             $user->setActivePassword(null);

    //             $this->symfonyStyle->writeln(' - update activePassword');

    //             $this->telegramFacade->sendAdminUserAdminMessage(
    //                 new Message('message', "[UserExpiredActivationPassword]: reset id={$user->getId()}"),
    //             );
    //         }

    //         $this->entityManager->flush();
    //         $this->entityManager->clear();
    //     }
    // }
}
