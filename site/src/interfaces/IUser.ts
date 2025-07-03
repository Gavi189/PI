// Definir a estrutura do usuário retornado pela API
export interface IUser {
  id: string;
  email: string;
  role?: string;
  token?: string;
}

// Interface para os dados da API
export interface ApiUserData {
  id_cliente: number | string;
  email: string;
  role?: string;
  token?: string;
}

export interface ApiResponse {
  status: string;
  data: ApiUserData;
  message?: string;
}

// Extender as interfaces padrão do NextAuth
import { DefaultUser } from "next-auth";

declare module "next-auth" {
  interface User extends IUser, DefaultUser {}
  interface Session {
    user: User;
    error?: string;
  }
  interface JWT {
    id: string;
    email: string;
    role?: string;
    token?: string;
  }
}
