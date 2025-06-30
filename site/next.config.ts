import type { NextConfig } from "next";

const nextConfig: NextConfig = {};

module.exports = {
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
        pathname: "/**", // Adjust the pathname as needed
      },
    ],
  },
};

export default nextConfig;
