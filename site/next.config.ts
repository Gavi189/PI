import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  async rewrites() {
    return [
      // NÃO redireciona rotas de autenticação do NextAuth!
      {
        source: "/api/auth/:path*",
        destination: "/api/auth/:path*",
      },
      // Redireciona o restante normalmente
      {
        source: "/api/:path*",
        destination: "http://localhost:8080/:path*",
      },
    ];
  },
  images: {
    remotePatterns: [
      {
        protocol: "https",
        hostname: "placehold.co",
        port: "",
        pathname: "/**",
      },
      {
        protocol: "http",
        hostname: "localhost",
        port: "8081",
        pathname: "/**",
      },
    ],
  },
};

export default nextConfig;
