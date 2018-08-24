icacls "storage"   /grant IUSR:(OI)(CI)F /T
icacls "bootstrap" /grant IUSR:(OI)(CI)F /T
icacls "storage"   /setowner IUSR
icacls "bootstrap" /setowner IUSR
