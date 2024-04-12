import base64
from cryptography.fernet import Fernet


'''def set_key():
    new_key = Fernet.generate_key()
    k = open("key.key", "wb")
    k.write(new_key)'''


def get_key():
    file = open("key.key", "rb")
    k = file.read()
    file.close()
    return k


key = get_key()
f = Fernet(key)


def view_password():
    file = open("passwords.txt", "r")
    for line in file.readlines():
        a = line.rstrip()
        user, pwd = a.split("|")
        decrypted_password = f.decrypt(pwd.encode()).decode()
        print("Name/Email: " + user + "password: " + decrypted_password)
    file.close()


def add_password():
    name = input("Account name or email address: ")
    password = input("Password: ")
    encrypted_password = f.encrypt(password.encode()).decode()
    file = open("passwords.txt", "a")
    file.write(name + " | " + encrypted_password + "\n")
    file.close()


while True:
    mode = input("would you like to view or add passwords? enter 'view' or 'add' or press q to quit ").lower()
    if mode == "q":
        break
    elif mode == 'view':
        view_password()
    elif mode == 'add':
        add_password()
    else:
        print("Invalid")
        continue
