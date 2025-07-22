"use client";

import { signOut } from "next-auth/react";
import { useRouter } from "next/navigation";

export default function LogoutPage() {
  const router = useRouter();

  return (
    <button
      onClick={() => {
        signOut({ redirect: false }).then(() => {
          router.push("/login");
        });
      }}
    >
      Sair
    </button>
  );
}
